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
use App\Models\Pay_loan_taken;
use App\Http\Requests\BillFormRequest as BillRequest;
use App\Http\Requests\ApplyLoanRequest as ApplyLoan;
use App\Http\Requests\changePasswordRequest as changePassword;
use App\Mail\walletNotify;
use App\Http\Requests\eedcFormRequest as eedcformRequest;
use App\Http\Requests\MobileTopUpRequest as TopupRequest;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Traits\sendingMails;
use App\Services\UserServices;

class DashboardController extends Controller
{
    use sendingMails;
    protected $user;

    public function __construct(UserServices $user) 
    {
        $this->user = $user;
        $this->middleware(['auth', 'verifyaccount' ]);
        
        
    }
    public function index()
    {
        $id = Auth::user()->id;
        $wallet = User::find($id)->wallet;
        $loans = Take_loan::where('wallet_key', $wallet->wallet_key)->count();
        
        $usernotify = DB::table('notifications')->where('wallet_key', $wallet->wallet_key)
                                 ->where('read', 0)->get();
        
        $data = [
            'total_credit'=> $wallet->credit_total,
            'total_debit'=> $wallet->debit_total,
            'aquired_loan'=> $wallet->loan_taken_amount,
            'loans'=> $loans,
           
            'user_notify'=> $usernotify
        ];
        
       
        Cache::put('wallet',$wallet);
        Session::put('balance', $wallet->wallet_balance);
         Session::put('owing', $wallet->owing);
        return view('dashboard.home')->with($data);
    }

 
    public function viewmobile_topup()
    {
        $wallet = $this->user->walletdetails();
        $loans = Take_loan::where('wallet_key', $wallet->wallet_key)->count();
        
        $usernotify = DB::table('notifications')->where('wallet_key', $wallet->wallet_key)
                                 ->where('read', 0)->get();
        $data = [
            'user_notify'=> $usernotify,
            'loans'=> $loans
        ];
        return view('dashboard.mobile_topup')->with($data);
    }
    
    public function wallet_topup()
    {
        $wallet = $this->user->walletdetails();
        $loans = Take_loan::where('wallet_key', $wallet->wallet_key)->count();
        
        $usernotify = DB::table('notifications')->where('wallet_key', $wallet->wallet_key)
                                 ->where('read', 0)->get();
        $data = [
            'usernotify'=> $usernotify,
            'loans'=> $loans
        ];
        return view('dashboard.wallet_topup')->with($data);
    }

    public function viewbills()
    {
        $wallet = $this->user->walletdetails();
        $usernotify = DB::table('notifications')->where('wallet_key', $wallet->wallet_key)
                                 ->where('read', 0)->get();
        $bills = DB::table('bills')->get();
        // $bills = Cache::get('bills', function () {
        //     return DB::table('bills')->get();
        // });
        //dd($bills);
        return view('dashboard.payBills', ['bills'=> $bills, 'user_notify'=> $usernotify]);
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

    public function notificationlist()
    {
      
        //$notify = $this->user->notifications();
        $user = auth()->user()->notifications()->orderBy('created_at','desc')->get()->toArray();
        dd($user);
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
        $message;
        
       
        $wallet_id = User::find($user_id)->wallet;
        
        $bill_type = Bill_type::find($data['package']);
        
        $bill_amount = $bill_type['bill_amount']; //get bill amount
        //dd($bill_amount);
        if($bill_amount > $wallet_id->wallet_balance){
            $msg = 'Insufficient Fund';
            $status = 0;
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
                'trans_pid'=> $paybill->payment_pid,
            ]);
    
            $changewallet = Wallet::where('wallet_key', $wallet_id->wallet_key)->first();
            $changewallet->wallet_balance = $wallet_id->wallet_balance;
            $olddebitTotal = $changewallet->debit_total;
            $newdebitTotal = $olddebitTotal + $bill_amount;
            $changewallet->debit_total = $newdebitTotal;
            $changewallet->save();

            
    
            //send a mail to the user
    
            return response()->json(['message'=> $msg]);
            //return response()->json(['message'=> 'Insufficient fund']);
        } else {
            $newbalance = $wallet_id->wallet_balance - $bill_amount; // substract bill amount from the wallet amount
            $msg = 'Transaction made successfully';
            $status = 2;
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
                'trans_pid'=> $paybill->payment_pid,
            ]);
    
            $changewallet = Wallet::where('wallet_key', $wallet_id->wallet_key)->first();
            $changewallet->wallet_balance = $newbalance;
            $olddebitTotal = $changewallet->debit_total;
            $newdebitTotal = $olddebitTotal + $bill_amount;
            $changewallet->debit_total = $newdebitTotal;
            $changewallet->save();
    
            //send a mail to the user
            $data = [
                'message'=> 'A '. $paybill->bills_type . ' payment was made',
                'read'=>0,
                'userwallet_key'=> $this->user->walletdetails()->wallet_key,
                'notify_id'=> $paybill->payment_pid,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ];
            $notifyadmin = $this->user->admin_notify($data);
    
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
            $status = 0;
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
                'trans_pid'=> $paybill->payment_pid,
            ]);
    
            $changewallet = Wallet::where('wallet_key', $wallet->wallet_key)->first();
            //$changewallet->wallet_balance = $wallet->wallet_balance;
            $olddebitTotal = $changewallet->debit_total;
            $newdebitTotal = $olddebitTotal + $data['amount'];
            $changewallet->debit_total = $newdebitTotal;
            $changewallet->save();

            return response()->json(['message'=> $msg]);
    
        }else {
            $newbalance = $wallet->wallet_balance - $data['amount']; // substract bill amount from the wallet amount
            $msg = 'Transaction made successfully';
            $status = 2;
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
                'trans_pid'=> $paybill->payment_pid
            ]);
    
            $changewallet = Wallet::where('wallet_key', $wallet->wallet_key)->first();
            $changewallet->wallet_balance = $newbalance;
            $olddebitTotal = $changewallet->debit_total;
            $newdebitTotal = $olddebitTotal + $data['amount'];
            $changewallet->debit_total = $newdebitTotal;
            $changewallet->save();
                
            $data = [
                'message'=> 'A '. $paybill->bills_type . ' payment was made',
                'read'=>0,
                'userwallet_key'=> $this->user->walletdetails()->wallet_key,
                'notify_id'=> $paybill->payment_pid,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ];
            $notifyadmin = $this->user->admin_notify($data);
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
    

    if($request['dataplan'] != '') {
        $data = explode('-', $request['dataplan']);
        $amount = $data[2];
        $dataplan = $data[0].'-'. $data[1];
        $type = 'Data Top up';
    }else {
        $amount = $request['amount'];
        $type = 'Airtime Topup';

    }

    if($amount > $wallet->wallet_balance){
        $balance = $wallet->wallet_balance;
        $msg = 'Insufficient Fund for Topup';
        $status = 0;
    }else{
        $balance = $wallet->wallet_balance - $amount;
        $msg = 'Mobile Top-up successful';
        $status = 2;

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
        'trans_pid'=> $topup->mobile_pid,
    ]);

        //send a mail to the user

        $wallet->wallet_balance = $balance;
        $olddebitTotal = $wallet->debit_total;
        $newdebitTotal = $olddebitTotal + $amount;
        $wallet->debit_total = $newdebitTotal;
        $wallet->save();

        $data = [
            'message'=> 'A '. $this->user->logUser()->fname . 'was made',
            'read'=>0,
            'userwallet_key'=> $this->user->walletdetails()->wallet_key,
            'notify_id'=> $topup->mobile_pid,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ];
        $notifyadmin = $this->user->admin_notify($data);

        return response()->json(['message'=> $msg]);

    
    
}



public function editprofile()
{   
    $user = Auth::user();
    $wallet = User::find($user->id)->wallet;
    $data = [
        'user'=> $user,
        'wallet_key'=> $wallet->wallet_key,
    ];
    return view('dashboard.profile')->with($data);
}

public function getchangePassword()
{
    return view('dashboard.changePassword');
}
    
public function DeleteAccount()
{
    return view('dashboard.deleteaccount');
}

public function changePassword(changePassword $request)
{
    $user = Auth::user();

    $input_oldpass = $request['old_password'];
    $newpass = $request['password'];
    
    $credentials = [
        'email'=> $user->email,
        'password'=> $input_oldpass
    ];

    if(auth()->attempt($credentials)) {
        $user->password = bcrypt($newpass);
        $user->save();

        Auth::logout();
        return redirect('/auth/login');
    }else {
        return redirect()->back()->withErrors("Old password doesn't match.")->withInput();
    }

}

public function Destory(Request $request)
{
    $this->validate($request,[
        'email'=>'email|required',
    ]);
    
    $user = User::where('email', $request['email'])->exists();
     $wallet = Wallet::where('wallet_key', $request['wallet_key'])->value('owing');
    //dd($email);
    if($user){
        if($wallet != 1){
            $user_trans = Transaction::where('wallet_key', $request['wallet_key'])->delete();
            $user_bills = Bill_payment::where('wallet_key', $request['wallet_key'])->delete();
            $user_loans = Take_loan::where('wallet_key', $request['wallet_key'])->delete();
            $user_paylaons = Pay_loan_taken::where('wallet_key', $request['wallet_key'])->delete();
            $user_mobiletopup = MobileTopup::where('wallet_key', $request['wallet_key'])->delete();
            $deleteuser = User::where('email', $request['email'])->delete();
            $deletewallet = Wallet::where('wallet_key', $request['wallet_key'])->delete();
    
            Auth::logout();
            return redirect('/auth/login');
        }else{
            return redirect()->back()->withErrors('Account cannot be deleted, still have unpaid loans')->withInput();
        }
       

    }else {
        return redirect()->back()->withErrors('Invaild Input Values')->withInput();
    }

}

public function shownotification($id)
{
    $removenotify = DB::table('notifications')->where('notify_id', $id)->update([
        'read'=> 1
    ]);
    $usernotify = DB::table('notifications')->where('wallet_key', $wallet->wallet_key)
                        ->where('read', 0)->get();
    $trans = Transaction::where('trans_pid', $id)->first();
    return view('dashboard.viewapprovedloan', [
        'usernotify'=>$usernotify,
        'trans'=> $trans
    ]);
}



private function generate_pid() {
    $pin=mt_rand(1000,9999);
    $user_no=str_shuffle($pin);
    return $user_no;
}
}
