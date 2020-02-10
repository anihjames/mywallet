<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use DB;
use Auth;
use App\User;
use App\Models\Bill_payment;
use App\Models\Bill_type;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Http\Requests\BillFormRequest as BillRequest;
use App\Mail\walletNotify;
use App\Http\Requests\eedcFormRequest as eedcformRequest;

class DashboardController extends Controller
{
    
    public function index()
    {
        $user = Auth::user()->fname;
        return view('dashboard.home', ['user'=>$user]);
    }

    public function viewbills()
    {
        $bills = Cache::get('bills', function () {
            return DB::table('bills')->get();
        });
        //dd($bills);
        return view('dashboard.payBills', ['bills'=> $bills]);
    }

    public function getbilltype($bill_id)
    {
        $output = '<option selected>'. 'Select a Package...' .'</option>';
        $bills_type = DB::table('bill_types')->where('bill_id', $bill_id)->select('id','bill_id', 'bill_amount', 'bill_description')->get();

        foreach ($bills_type as $package) {
            $output .= '<option value="'.$package->id .'">'. $package->bill_description . ' ' . '&#8358;' . $package->bill_amount  .'</option>';
        }
       
        return $output;
    }

    public function PayBills(BillRequest $request)
    {
        $data = $request->all();
        $user_id = Auth::user()->id;
        $pid = $this->generate_pid();
        $msg = '';
        $status = '';
        
       
        $wallet_id = User::find($user_id)->wallet;
        $bill_type = Bill_type::find($data['package'])->first();
        
        $bill_amount = $bill_type->bill_amount; //get bill amount
        
        if($bill_amount > $wallet_id->wallet_balance){
            $msg = 'Insufficient Fund';
            $status = 'failed';
            $paybill = Bill_payment::create([
                'payment_pid' => $pid,
                'wallet_key'=> $wallet_id->wallet_key,
                'bills_type'=> $bill_type->bill_description,
                'bills_amount'=> $bill_type->bill_amount,
                'type_code'=> $request['card_number'],
                'status'=> $status,
                'bill_type_id'=> $bill_type->id
            ]);
    
            $transaction = Transaction::create([
                'trans_type'=> 'debit',
                'wallet_key'=> $wallet_id->wallet_key,
                'trans_status'=> $paybill->status,
                'trans_name'=> $paybill->bills_type,
                'trans_amount'=> $paybill->bills_amount,
                'balance'=> $wallet_id->wallet_balance,
            ]);
    
            $changewallet = Wallet::where('wallet_key', $wallet_id->wallet_key)->first();
            $changewallet->wallet_balance = $wallet_id->wallet_balance;
            $changewallet->save();

            
    
            //send a mail to the user
    
            return response()->json(['message'=> $msg]);
            //return response()->json(['message'=> 'Insufficient fund']);
        } else {
            $newbalance = $wallet_id->wallet_balance - $bill_amount; // substract bill amount from the wallet amount
            $msg = 'Transaction made successfully';
            $status = 'successfull';
            $paybill = Bill_payment::create([
                'payment_pid' => $pid,
                'wallet_key'=> $wallet_id->wallet_key,
                'bills_type'=> $bill_type->bill_description,
                'bills_amount'=> $bill_type->bill_amount,
                'type_code'=> $request['card_number'],
                'status'=> $status,
                'bill_type_id'=> $bill_type->id
            ]);
    
            $transaction = Transaction::create([
                'trans_type'=> 'debit',
                'wallet_key'=> $wallet_id->wallet_key,
                'trans_status'=> $paybill->status,
                'trans_name'=> $paybill->bills_type,
                'trans_amount'=> $paybill->bills_amount,
                'balance'=> $newbalance,
            ]);
    
            $changewallet = Wallet::where('wallet_key', $wallet_id->wallet_key)->first();
            $changewallet->wallet_balance = $newbalance;
            $changewallet->save();
    
            //send a mail to the user
    
            return response()->json(['message'=> $msg]);
        }

       
    }

    public function eedcPayment(eedcformRequest $request)
    {
        $data = $request->all();
        $user_id = Auth::user()->id;
        $pid = $this->generate_pid();
        $msg = '';
        $status = '';

        $wallet = User::find($user_id)->wallet;
        //$wallet = $wallet->wallet_key;

        if($data['amount'] > $wallet->wallet_balance) {
            $msg = 'Insufficient Fund';
            $status = 'failed';
            $paybill = Bill_payment::create([
                'payment_pid' => $pid,
                'wallet_key'=> $wallet->wallet_key,
                'bills_type'=> 'EEDC'. '-' . $data['state'] ,
                'bills_amount'=> $data['amount'],
                'type_code'=> $data['meter_number'],
                'status'=> $status,
                'bill_type_id'=> $data['bill_type_id']
            ]);

            $transaction = Transaction::create([
                'trans_type'=> 'debit',
                'wallet_key'=> $wallet->wallet_key,
                'trans_status'=> $paybill->status,
                'trans_name'=> $paybill->bills_type,
                'trans_amount'=> $paybill->bills_amount,
                'balance'=> $wallet_id->wallet_balance,
            ]);
    
            $changewallet = Wallet::where('wallet_key', $wallet_id->wallet_key)->first();
            $changewallet->wallet_balance = $wallet->wallet_balance;
            $changewallet->save();
    
        }else {
            $newbalance = $wallet->wallet_balance - $data['amount']; // substract bill amount from the wallet amount
            $msg = 'Transaction made successfully';
            $status = 'successfull';
            $paybill = Bill_payment::create([
                'payment_pid' => $pid,
                'wallet_key'=> $wallet->wallet_key,
                'bills_type'=> 'EEDC'. '-' . $data['state'] ,
                'bills_amount'=> $data['amount'],
                'type_code'=> $data['meter_number'],
                'status'=> $status,
                'bill_type_id'=> $data['bill_type_id']
            ]);
    
            $transaction = Transaction::create([
                'trans_type'=> 'debit',
                'wallet_key'=> $wallet->wallet_key,
                'trans_status'=> $paybill->status,
                'trans_name'=> $paybill->bills_type,
                'trans_amount'=> $paybill->bills_amount,
                'balance'=> $newbalance,
            ]);
    
            $changewallet = Wallet::where('wallet_key', $wallet_id->wallet_key)->first();
            $changewallet->wallet_balance = $newbalance;
            $changewallet->save();
    
            //send a mail to the user
    
            return response()->json(['message'=> $msg]);
        }



        //$pay = $this->BillPayment($data);
        
        
    }

    public function getBill() 
    {
        $bills = Bill_payment::all();
    }

    

    private function generate_pid() {
        $pin=mt_rand(100000,999999);
        $user_no=str_shuffle($pin);
        return $user_no;
     }
}
