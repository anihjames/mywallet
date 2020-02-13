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
use App\Models\MobileTopup;
use App\Models\Take_loan;
use App\Http\Requests\BillFormRequest as BillRequest;
use App\Http\Requests\ApplyLoanRequest as ApplyLoan;
use App\Mail\walletNotify;
use App\Http\Requests\eedcFormRequest as eedcformRequest;
use App\Http\Requests\MobileTopUpRequest as TopupRequest;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class DashboardController extends Controller
{
    
    public function __construct() 
    {
        $this->middleware(['auth', 'verifyaccount']);
        
        
    }
    public function index()
    {
        $id = Auth::user()->id;
        $wallet = User::find($id)->wallet;
        Cache::put('wallet',$wallet);
        $is_owing = DB::table('pay_loan_takens')->where('wallet_key', $wallet->wallet_key)->select('still_owing')->get(); 
        //dd($wallet->wallet_key);
        Session::put('balance', $wallet->wallet_balance);
         Session::put('still_owing', $is_owing);
        return view('dashboard.home');
    }

    public function viewmobile_topup()
    {
        return view('dashboard.mobile_topup');
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

    

    private function clearcache()
    {
        if(!Auth::check()) {
            Cache::forget('wallet');
        }
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
    
            // $changewallet = Wallet::where('wallet_key', $wallet_id->wallet_key)->first();
            // $changewallet->wallet_balance = $wallet_id->wallet_balance;
            // $olddebitTotal = $changewallet->debit_total;
            // $newdebitTotal = $olddebitTotal + $bill_amount;
            // $changewallet->debit_total = $newdebitTotal;
            // $changewallet->save();

            
    
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
            $olddebitTotal = $changewallet->debit_total;
            $newdebitTotal = $olddebitTotal + $bill_amount;
            $changewallet->debit_total = $newdebitTotal;
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
                'balance'=> $wallet->wallet_balance,
            ]);
    
            // $changewallet = Wallet::where('wallet_key', $wallet->wallet_key)->first();
            // $changewallet->wallet_balance = $wallet->wallet_balance;
            // $olddebitTotal = $changewallet->debit_total;
            // $newdebitTotal = $olddebitTotal + $data['amount'];
            // $changewallet->debit_total = $newdebitTotal;
            // $changewallet->save();

            return response()->json(['message'=> $msg]);
    
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
    
            $changewallet = Wallet::where('wallet_key', $wallet->wallet_key)->first();
            $changewallet->wallet_balance = $newbalance;
            $olddebitTotal = $changewallet->debit_total;
            $newdebitTotal = $olddebitTotal + $data['amount'];
            $changewallet->debit_total = $newdebitTotal;
            $changewallet->save();
    
            //send a mail to the user
    
            return response()->json(['message'=> 'EEDC Bill Paid Successfully']);
        
        
    }
}


public function Topup(TopupRequest $request)
{
    $user_id = Auth::user()->id;
    $wallet = User::find($user_id)->wallet;
    $topupdecision = '';
    $amount = '';
    $type = '';
    $dataplan= '';
    $mobile_pid = $this->generate_pid();
    $balance = '';
    $msg = '';
    $status = '';
    //dd($mobile_pid);

    if($request['dataplan'] != '') {
        $data = explode('-', $request['dataplan']);
        $amount = $data[2];
        $dataplan = $data[0].''. $data[1];
        $type = 'Data Top up';
    }else {
        $amount = $request['amount'];
        $type = 'Airtime Topup';

    }

    if($amount > $wallet->wallet_balance){
        $balance = $wallet->wallet_balance;
        $msg = 'Insufficient Fund for Topup';
        $status = 'failed';
    }else{
        $balance = $wallet->wallet_balance - $amount;
        $msg = 'Mobile Top-up successful';
        $status = 'successfully';

    }

    $topup = MobileTopup::create([
        'wallet_key'=> $wallet->wallet_key,
        'mobile_number'=> $request['mobile_number'],
        'network_provider'=> $request['network_provider'],
        'amount'=> $amount,
        'country_code'=> $request['country_code'],
        'status'=> $status,
        'toptype'=> $type,
        'dataplan'=> $dataplan,
        'mobile_pid'=> $mobile_pid,

    ]);
    
    $transaction = Transaction::create([
        'trans_type'=> 'debit',
        'wallet_key'=> $wallet->wallet_key,
        'trans_status'=> $topup->status,
        'trans_name'=> 'Mobile Topup',
        'trans_amount'=> $topup->amount,
        'balance'=> $balance,
    ]);

        //send a mail to the user

        $wallet->wallet_balance = $balance;
        $olddebitTotal = $wallet->debit_total;
        $newdebitTotal = $olddebitTotal + $amount;
        $wallet->debit_total = $newdebitTotal;
        $wallet->save();

        return response()->json(['message'=> $msg]);

    
    
}




    

    private function generate_pid() {
        $pin=mt_rand(100000,999999);
        $user_no=str_shuffle($pin);
        return $user_no;
     }
}
