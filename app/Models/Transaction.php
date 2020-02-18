<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['trans_type', 'wallet_key', 'trans_status', 'trans_name', 'trans_amount', 'balance','trans_pid', 'created_at', 'updated_at'];

    public function wallet()
    {
        return $this->belongTo('App\Models\Wallet', 'wallet_key', 'wallet_key');
    }
}
