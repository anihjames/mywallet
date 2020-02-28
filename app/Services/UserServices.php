<?php

namespace App\Services;

// use App\Repositories\LoanRepository;
// use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Auth;
use App\Interfaces\Loaninterface;
use App\Interfaces\Userinterface;
use App\Interfaces\Transactioninterface;


class UserServices
{
    protected $user, $loan, $userlevel, $transaction;
    

    public function __construct(Loaninterface $loanRepo, Userinterface $userRepo, Transactioninterface $transRepo)
    {
        $this->user = $userRepo;
        $this->loan = $loanRepo;
        $this->transaction = $transRepo;

    }

    public function getTransactions($key)
    {
        return $this->user->getTransactions($key);
    }

    public function topups($key)
    {
        return $this->user->gettopup($key);
    }

    public function bills($key)
    {
        return $this->user->getbills($key);
    }

    public function notifications()
    {
        $notifications = auth()->user()->notifications()->orderBy('created_at','desc')->get()->toArray();
    }

    
    public function logUser()
    {
        return $this->user->logUser();
    }

    

    public function loanrate()
    {
        $userlevel = $this->logUser()->level;
       //dd($userlevel);
        return $this->loan->rate($userlevel);
    }

    public function userlevel()
    {
        $level = $this->user->userlevel();
        if($level == 1) {
            $this->userlevel = "beginner";
        }elseif($level == 2) {
            $this->userlevel = "intermediate";
        }elseif($level == 3) {
            $this->userlevel = "advance";
        }

        return $this->userlevel;
    }

    public function applyforloan($loanrequests)
    {
        $walletdetails = $this->user->walletdetails();
        $data = [
            'wallet_key'=> $walletdetails->wallet_key,
            'loanrequest'=> $loanrequests,
            'loan_pid'=> $this->generate_pid(),
        ];
        $loan = $this->loan->create($data);
        $newcredit = $walletdetails->credit_total + $loan->loan_amount;    
        $newbalance = $walletdetails->wallet_balance + $loan->loan_amount;
        $amountowing = $walletdetails->loan_taken_amount + $loan->loan_amount;
        $transdata = [
            'loans'=>$loan,
            'trans_name'=> 'Applied For Loan',
            'trans_type'=> 'credit',
            'newbalance'=> $newbalance,
        ];
        $walletupdate = [
            'wallet_balance'=> $newbalance,
            'credit_total'=> $newcredit,
            'owing'=> 1,
            'loan_taken_amount'=> $amountowing,
        ];
        $transaction =  $this->transaction->create($transdata);
        $updatewallet = $this->user->updateWallet($walletdetails->wallet_key, $walletupdate);
        $data = [
            'updatewallet'=> $updatewallet,
            'transaction'=> $transaction,
        ];

       return $data;

    }

    public function payloan($loanrequests)
    {
       
        $stillowing = '';
        $walletdetails = $this->user->walletdetails();
        $userloan = $this->loan->getloan($loanrequests['orderID']);
        $amountleft = intVal($userloan->repayment_amount - $loanrequests['amount']);
        $newbalance = $walletdetails->wallet_balance - $loanrequests['amount'];
        if($newbalance > 0) {
            $stillowing = 1;
        }else{
            $stillowing = 0;
        }

        $data = [
            'wallet_key'=> $walletdetails->walllet_key,
            'loanrequest'=>$loanrequests,
        ];
    }

    public function notifyuser($mesasge)
    {
        //$user = $this->logUser()->role;
        $key = $this->user->walletdetails()->wallet_key;
        return $this->user->notify($key, $mesasge);
    }


    public function admin_notify(array $message)
    {
        return $this->user->notifyadmin($message);
        
    }

    public function walletdetails()
    {
        return $this->user->walletdetails();
    }

    

    public function getloandetails($pid)
    {
        return $this->loan->getloan($pid);
    }


    

    public function generate_pid() {
        $pin=mt_rand(1000,9999);
        $user_no=str_shuffle($pin);
        return $user_no;
     }


    

    
}