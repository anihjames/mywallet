<?php

namespace App\Repositories;


use App\User;
use App\Models\Wallet;
use DB;
use Auth;
use App\Interfaces\Userinterface;

class UserRepository implements Userinterface
{
    protected $userdata;

    public function create()
    {

    }

    public function update()
    {

    }

    public function getTransactions($key)
    {
        return Wallet::where('wallet_key', $key)->first()->transactions;
        //return $this->userdata->where('wallet_key', $key) ->first()->transactions;
    }

    public function gettopup($key)
    {
        return Wallet::where('wallet_key', $key)->first()->topups;
        //return $this->userdata->where('wallet_key',$key)->first()->topups;
    }

    public function getBills($key)
    {
        return Wallet::where('wallet_key', $key)->first()->billpayments;
        //return $this->userdata->where('wallet_key', $key)->first()->billpayment;
    }

    public function logUser()
    {
        return Auth::user();
    }

    public function userlevel()
    {
        return $this->logUser()->level;
    }

    
}