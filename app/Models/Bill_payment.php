<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill_payment extends Model
{
    protected $fillable = ['payment_pid', 'wallet_key', 'bills_type', 'bills_amount', 'type_code', 'status', 'bill_type_id', 'created_at', 'update_at'];

    public function wallet()
    {
        return $this->belongTo('App\Models\Wallet', 'wallet_key', 'wallet_key');
    }

   
}
