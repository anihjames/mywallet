<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pay_loan_taken extends Model
{
    protected $fillable = [
            'wallet_key',
            'loan_pid',
            'amount_paid',
            'amount_left',
            'verified',
            // 'still_owing',
            'created_at',
            'updated_at',
    ];
    
    public function wallet()
    {
        return $this->belongTo('App\Models\Wallet', 'wallet_key', 'wallet_key');
    }
}
