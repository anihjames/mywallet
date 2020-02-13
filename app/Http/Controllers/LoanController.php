<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Take_loan;
use Carbon\Carbon;
use App\Http\Requests\ApplyLoanRequest as ApplyLoan;
use Auth;
use App\User;
use App\Models\Transaction;
use App\Mobels\Wallet;
use DB;

class LoanController extends Controller
{
    public function editloan($id)
    {
        $loan = Take_loan::find($id);
        return view('modals.editloan', ['loan'=> $loan]);
    }

    public function ApplyforLoan(ApplyLoan $request)
{
    //dd($request->all());
    // $key = '';
    // if(Cache::has('wallet')) {
    //  $wallet = Cache::get('wallet');   
    // }else {
        $id = Auth::user()->id;
        $wallet = User::find($id)->wallet;
        $key = $wallet->wallet_key;
    //}
    $loan_pid = $this->generate_pid();
    $dt = carbon::now();
    //$status = '';
    

    $takeloan = Take_loan::create([
        'wallet_key'=> $wallet->wallet_key,
        'loan_pid'=> $loan_pid,
        'loan_amount'=> $request['loan_amount'],
        'loan_app_date'=> $dt->isoFormat('dddd D, Y'),
        'loan_length'=> $request['loan_tenure'] .' '.$request['months'],
        'verified'=> 1,
    ]);

    // if($takeloan->verified == 0){
    //     $status = 'awaiting approval';
    // }elseif($takeloan->verified == 2){
    //     $status = 'Approved';
    // }else{
    //     $status = 'failed';
    // }
    $newbalance = $wallet->wallet_balance + $request['amount'];
    //$oldcredit = $wallet->credit_total;
    $newcredit = $wallet->credit_total + $request['amount'];    
    $transaction = Transaction::create([
        'trans_type'=> 'credit',
        'wallet_key'=> $wallet->wallet_key,
        'trans_status'=> $takeloan->verified,
        'trans_name'=> 'Applied For Loan',
        'trans_amount'=> $takeloan->loan_amount,
        'balance'=> $newbalance,
    ]);

    $wallet = DB::table('wallets')->where('wallet_key',$wallet->wallet_key)->update([
        'wallet_balance'=> $newbalance,
        'credit_total'=> $newcredit
    ]);

    return response()->json(['message'=>'Loan as be Placed' ]);


    
}

    public function updateloan(ApplyLoan $request)
    {
        $id = Auth::user()->id;
        $wallet = User::find($id)->wallet;
        $key = $wallet->wallet_key;
        $db = Carbon::now();

        $update = DB::table('take_loans')->update([
            'loan_amount'=> $request['amount'],
            'loan_length'=> $request['loan_tenure'],
            'updated_at'=> $db->date,
        ]);
    }

    private function generate_pid() {
        $pin=mt_rand(100000,999999);
        $user_no=str_shuffle($pin);
        return $user_no;
     }

}
