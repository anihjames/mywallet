<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paystack;
use Illuminate\Support\Facades\Session;
use App\Models\Transaction;
use Auth;
use App\User;
use DB;
use Carbon\Carbon;

class PaymentController extends Controller
{
   //public $status;
    public function redirectToGateway(Request $request)
    {
        $id = $request['orderID'];
        Session::put('orderid', $id);
        Session::put('tran_type', $request['tran_type']);
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
        $amount = $paymentDetails['data']['amount']/ 100;
        $res = $paymentDetails['data']['status'];
        $id = $paymentDetails['data']['id'];
        
        $stillowing;
        $tran_type = Session::get('tran_type');
        $orderid = Session::get('orderid');
        $status;
        
        
        
        if($tran_type == 'pay-loan') {
            $this->status = $this->payloan($amount, $res, $tran_type);
        }elseif($tran_type == 'top-up'){
            dd($tran_type);
            $this->status = $this->topup($amount, $res, $tran_type);
        }
        
        //dd($this->status);
        //return \redirect('/home');
     
    }

    public function payloan(Request $request)
    {
        $res;
        $id = Auth::user()->id;
        $wallet = User::find($id)->wallet;
        $tran_type;
        $balance = DB::table('take_loans')->where('loan_pid', $request['orderID'])->value('loan_amount');
        $newbalance = $balance - $request['amount'];
        
        
        
        $transaction = Transaction::create([
            'trans_type'=> 'credit',
            'trans_name'=> $request['tran_type'],
            'trans_amount'=> $request['amount'],
            'wallet_key'=> $wallet->wallet_key,
            'trans_status'=> '2',
            'balance' => $newbalance,
            'trans_pid'=> $request['orderID'],
        ]);
        
        $amountleft = intVal($wallet->loan_taken_amount - $request['amount']);
        if($newbalance > 0) {
            $stillowing = 1;
        }else{
            $stillowing = 0;
        }

        $pay = DB::table('pay_loan_takens')->insert([
            'wallet_key'=> $wallet->wallet_key,
            'loan_pid'=> $request['orderID'],
            'payment_method'=> 'card',
            'amount_paid'=> $request['amount'],
            'amount_left'=> $newbalance,
            'verified'=> '1',
            'still_owing'=> $stillowing,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);

        $updatewallet = DB::table('wallets')->where('wallet_key', $wallet->wallet_key)->update([
            'loan_amount_left'=> $amountleft,
            'owing'=> $stillowing,
        ]);

         return \redirect('/home');
    }

    public function topup(Request $request)
    {

       
        $res;   
        $id = Auth::user()->id;
        $wallet = User::find($id)->wallet;
        $tran_type;
        // $balance = DB::table('take_loans')->where('loan_pid', $request['orderID'])->value('loan_amount');
        // $newbalance = $balance - $amount;

        //dd($amount);
        $transaction = Transaction::create([
            'trans_type'=> 'credit',
            'trans_name'=> $request['tran_type'],
            'trans_amount'=> $request['amount'],
            'wallet_key'=> $wallet->wallet_key,
            'trans_status'=> '2',
            'balance' => intVal($wallet->wallet_balance + $request['amount']),
            'trans_pid'=> $id,
        ]);

        $updatewallet = DB::table('wallets')->where('wallet_key', $wallet->wallet_key)->update([
            'wallet_balance'=> intVal($wallet->wallet_balance + $request['amount']),
            'credit_total'=> intVal($wallet->credit_total + $request['amount'])
        ]);

         return \redirect('/home');
        



    }
}
