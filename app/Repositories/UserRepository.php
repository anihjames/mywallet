<?php

namespace App\Repositories;

use App\User;
use App\Models\Wallet;
use DB;
use Auth;

class UserRepository
{
    protected $userdata;

    public function __construct(Wallet $wallet)
    {
        $this->userdata = $wallet;
    }

    public function create()
    {

    }

    public function update()
    {

    }

    public function getTransactions($key)
    {
        return $this->userdata->where('wallet_key', $key) ->first()->transactions;
    }

    public function gettopup($key)
    {
        return $this->userdata->where('wallet_key',$key)->first()->topups;
    }

    public function getBills($key)
    {
        return $this->userdata->where('wallet_key', $key)->first()->billpayment;
    }

    
}