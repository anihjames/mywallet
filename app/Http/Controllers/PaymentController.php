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
use App\Services\UserServices;
use App\Models\Take_loan;
use App\Models\Pay_loan_taken;

class PaymentController extends Controller
{
   //public $status;
   protected $userservice;

   public function __construct(UserServices $userservice)
   {
    $this->userservice = $userservice;
   }
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
        $payloan = $this->userservice->payloan($request->all());
        
        $res;
        $id = Auth::user()->id;
        $wallet = User::find($id)->wallet;
        $tran_type;
        $repayment_amount = Take_loan::where('loan_pid', $request['orderID'])->select('repayment_amount', 'amount_paid', 'amount_left')->first();  
        $amount_left = $repayment_amount->repayment_amount - $request['amount'];
        $stillowing;
        $subamount;
        
        $pay = Pay_loan_taken::create([
            'wallet_key'=> $wallet->wallet_key,
            'loan_pid'=> $request['orderID'],
           
            'amount_paid'=> $request['amount'],
            'amount_left'=> $amount_left,
            'verified'=> '1',
            
        ]);
        


        
        $transaction = Transaction::create([
            'trans_type'=> 'credit',
            'trans_name'=> $request['tran_type'],
            'trans_amount'=> $request['amount'],
            'wallet_key'=> $wallet->wallet_key,
            'trans_status'=> '2',
            'balance' => $amount_left,
            'trans_pid'=> $request['orderID'],
        ]);
        
        $newbalance = intVal($wallet->loan_taken_amount - $request['amount']);
        if($newbalance > 0) {
            $stillowing = 1;
        }else{
            $stillowing = 0;
        }

        
        $data = [
            'message'=> 'A loan Payment was made',
            'read'=>0,
            'userwallet_key'=> $this->userservice->walletdetails()->wallet_key,
            'notify_id'=> $transaction->trans_pid,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ];
        $notifyadmin = $this->userservice->admin_notify($data);

        $updateloan = DB::table('take_loans')->where('loan_pid', $request['orderID'])->update([
            'amount_left'=> $repayment_amount->amount_left - $request['amount'],
            'amount_paid'=> $repayment_amount->amount_paid + $request['amount']
        ]);

        $updatewallet = DB::table('wallets')->where('wallet_key', $wallet->wallet_key)->update([
            'loan_amount_left'=> $newbalance,
            'owing'=> $stillowing,
        ]);

        $res = $this->updateloans($request['orderID']);

         return \redirect()->back()->with('status', 'Loan Paid');
    }

    public function updateloans($loanpid)
    {
        $loandetails = Take_loan::where('loan_pid', $loanpid)->first();

        if($loandetails->repayment_amount <= $loandetails->amount_paid){
            $loandetails->payment_status = 1;
        }else{
            $loandetails->payment_status = 0;
        }
        $loandetails->save();
        return true;

    }

    public function topup(Request $request)
    {

       
        $res;   
        $id = Auth::user()->id;
        $wallet = User::find($id)->wallet;
        $tran_type;
        
        $transaction = Transaction::create([
            'trans_type'=> 'credit',
            'trans_name'=> $request['tran_type'],
            'trans_amount'=> $request['amount'],
            'wallet_key'=> $wallet->wallet_key,
            'trans_status'=> '2',
            'balance' => intVal($wallet->wallet_balance + $request['amount']),
            'trans_pid'=> $this->userservice->generate_pid(),
        ]);

        $updatewallet = DB::table('wallets')->where('wallet_key', $wallet->wallet_key)->update([
            'wallet_balance'=> intVal($wallet->wallet_balance + $request['amount']),
            'credit_total'=> intVal($wallet->credit_total + $request['amount'])
        ]);

        $data = [
            'message'=> 'wallet top ',
            'read'=>0,
            'userwallet_key'=> $this->userservice->walletdetails()->wallet_key,
            'notify_id'=> $transaction->trans_pid,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ];
        $notifyadmin = $this->userservice->admin_notify($data);


         return \redirect('/home');
        



    }


    
}
