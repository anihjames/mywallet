<?php

namespace App\Repositories;

use App\Models\MobileTopup;
use App\Models\Wallet;

class TopupsRepository
{
    protected $topups;

    public function __construct(MobileTopup $topup)
    {
        $this->topups = $topup;
    }

    public function mobiletopup()
    {

    }

    public function walletTopup()
    {

    }

    public function getTopup()
    {
        return $this->topups->join('wallets', 'wallets.wallet_key', '=', 'mobile_topups.wallet_key')
                                ->join('users', 'users.id', '=', 'wallets.user_id')
                                ->select('mobile_topups.id','mobile_topups.toptype','mobile_topups.mobile_number','mobile_topups.network_provider', 'mobile_topups.amount', 'mobile_topups.status','mobile_topups.mobile_pid', 'mobile_topups.created_at', 'users.fname', 'users.lname')
                                ->orderBy('created_at', 'desc');
    }

    public function getTopupbykey($key)
    {

    }
}