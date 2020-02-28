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
        $wallet = $this->userService->walletdetails();
        $loans = Take_loan::where('wallet_key', $wallet->wallet_key)->count();
        
        $usernotify = DB::table('notifications')->where('wallet_key', $wallet->wallet_key)
                                 ->where('read', 0)->get();
        return view('dashboard.loan', ['user'=> $user, 'rate'=> $loan_rate, 'level'=> $userlevel, 'user_notify'=> $usernotify, 'loans'=> $loans]);
    }

    
    public function editloan($id)
    {
        $loan = Take_loan::find($id);
        return view('modals.editloan', ['loan'=> $loan]);
    }

    public function ApplyforLoan(ApplyLoan $request)
    {
        
        $applyloan = $this->userService->applyforloan($request->all());
        // dd($applyloan['updatewallet']);
        if($applyloan['updatewallet'] == 1){
            $data = [
                'message'=> 'Loan Application ',
                'read'=>0,
                'userwallet_key'=> $this->userService->walletdetails()->wallet_key,
                'notify_id'=> $applyloan['transaction']['trans_pid'],
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
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
        $loans = DB::table('take_loans')->where('wallet_key', $wallet_key)
                        ->where('payment_status',0)
                        ->get();
        
        //$loans = Take_loan::where('wallet_key', $wallet->wallet_key)->count();

        $usernotify = DB::table('notifications')->where('wallet_key', $wallet_key)
                                    ->where('read', 0)->get();
        
        
        return view('dashboard.payloan', ['loans'=> $loans, 'user_notify'=> $usernotify])->with('loans',$loans);
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

    public function loanstatement()
    {   $wallet_key = $this->userService->walletdetails()->wallet_key;
        $usernotify = DB::table('notifications')->where('wallet_key', $wallet_key)
                             ->where('read', 0)->get();

        return view('dashboard.loanstatement',['user_notify'=> $usernotify]);
    }

    private function generate_pid() {
        $pin=mt_rand(100000,999999);
        $user_no=str_shuffle($pin);
        return $user_no;
     }

}
