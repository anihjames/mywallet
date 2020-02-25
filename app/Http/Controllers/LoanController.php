<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Take_loan;
use Carbon\Carbon;
use App\Http\Requests\ApplyLoanRequest as ApplyLoan;
use Auth;
use App\User;
use App\Models\Transaction;
//use App\Models\Wallet;
use App\Models\Loan;
use DB;
use App\Traits\sendingMails;
use App\Services\UserServices;
// use App\Interfaces\Loaninterface;
// use App\Interfaces\Userinterface;


class LoanController extends Controller 
{
    use sendingMails;
    protected $userRepo, $loanRepo, $userService;


    public function __construct(UserServices $userservice)
    {
        $this->userService = $userservice;
    }

    public function getloanview()
    {
        $user = $this->userService->logUser();
        $userlevel = $this->userService->userlevel();
        $loan_rate = $this->userService->loanrate();
        return view('dashboard.loan', ['user'=> $user, 'rate'=> $loan_rate, 'level'=> $userlevel]);
    }
    public function editloan($id)
    {
        $loan = Take_loan::find($id);
        return view('modals.editloan', ['loan'=> $loan]);
    }

    public function ApplyforLoan(ApplyLoan $request)
    {
        dd($request->all());
        $id = Auth::user()->id;
        $wallet = User::find($id)->wallet;
        $key = $wallet->wallet_key;
        $loan_pid = $this->generate_pid();
        $dt = carbon::now();
    
    $takeloan = Take_loan::create([
        'wallet_key'=> $wallet->wallet_key,
        'loan_pid'=> $loan_pid,
        'loan_amount'=> $request['loan_amount'],
        'loan_app_date'=> $dt->isoFormat('dddd D, Y'),
        'loan_length'=> $request['loan_tenure'] .' '.$request['months'],
        'verified'=> 1,
    ]);

    $newcredit = $wallet->credit_total + $takeloan->loan_amount;    
    $newbalance = $wallet->wallet_balance + $takeloan->loan_amount;
    $amountowing = $wallet->loan_taken_amount + $takeloan->loan_amount;
    //dd($newcredit);
    $transaction = Transaction::create([
        'trans_type'=> 'credit',
        'wallet_key'=> $wallet->wallet_key,
        'trans_status'=> $takeloan->verified,
        'trans_name'=> 'Applied For Loan',
        'trans_amount'=> $takeloan->loan_amount,
        'balance'=> $newbalance,
        'trans_pid'=> $takeloan->loan_pid,
    ]);
    $loan['key'] = $takeloan->wallet_key;
    $loan['pid'] = $takeloan->loan_pid;
    $loan['amount'] = $takeloan->loan_amount;
    $loan['date'] = $takeloan->loan_app_date;
    $loan['length'] = $takeloan->loan_length;
    
    $wallet = DB::table('wallets')->where('wallet_key',$wallet->wallet_key)->update([
        'wallet_balance'=> $newbalance,
        'credit_total'=> $newcredit,
        'owing'=> 1,
        'loan_taken_amount'=> $amountowing,
    ]);

    //$notifyadmin = $this->notifyadmin($loan);

   

    return response()->json(['message'=>'Loan as be Placed' ]);


    
}

    public function updateloan(ApplyLoan $request)
    {
        $id = Auth::user()->id;
        $wallet = User::find($id)->wallet;
        $key = $wallet->wallet_key;
        $db = Carbon::now();

        $update = DB::table('take_loans')->where('loan_pid', $request['loan_pid'])->update([
            'loan_amount'=> $request['loan_amount'],
            'loan_length'=> $request['loan_tenure'],
            'updated_at'=> $db,
        ]);

        return redirect()->back()->with('message', 'Update maked successfully');
    }

    public function payloan()
    {
        $user = Auth::user()->wallet;
        $wallet_key = $user->wallet_key;
        $loans = DB::table('take_loans')->where('wallet_key', $wallet_key)->get();
        
        
        return view('dashboard.payloan')->with('loans',$loans);
    }

    private function generate_pid() {
        $pin=mt_rand(100000,999999);
        $user_no=str_shuffle($pin);
        return $user_no;
     }

}
