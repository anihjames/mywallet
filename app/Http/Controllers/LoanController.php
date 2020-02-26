<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Take_loan;
use Carbon\Carbon;
use App\Http\Requests\ApplyLoanRequest as ApplyLoan;
use Auth;
use App\User;
use App\Models\Transaction;

use App\Models\Loan;
use DB;
use App\Traits\sendingMails;
use App\Services\UserServices;



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
        
        $applyloan = $this->userService->applyforloan($request->all());
        if($applyloan == 1){
            $data = [
                'message'=> 'Loan Application was made',
                'read'=>0,
                'userwallet_key'=> $this->userService->walletdetails()->wallet_key,
            ];
            $notifyadmin = $this->userService->admin_notify($data);
            //notify admin
            return response()->json(['status'=>200]);
        }else {
            return response()->json(['status'=> 419]);
        }
    
    
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

    public function getloandetails($id)
    {
        $loandetails = $this->userService->getloandetails($id);
        
         $expirationdate = $loandetails->expiration_date->isoFormat('MMMM Do YYYY, h:mm:ss a');

        $data = [
            'expire'=> $expirationdate,
            'loandata'=> $loandetails,
        ];

       return $data;
    }

    private function generate_pid() {
        $pin=mt_rand(100000,999999);
        $user_no=str_shuffle($pin);
        return $user_no;
     }

}
