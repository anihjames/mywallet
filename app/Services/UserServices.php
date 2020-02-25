<?php

namespace App\Services;

use App\Repositories\LoanRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Auth;
use App\Interfaces\Loaninterface;
use App\Interfaces\Userinterface;

class UserServices
{
    protected $user, $loan, $userlevel;
    

    public function __construct(Loaninterface $loanRepo, Userinterface $userRepo)
    {
        $this->user = $userRepo;
        $this->loan = $loanRepo;
        //$this->loan = new LoanRepository();

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


    

    
}