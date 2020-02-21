<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pay_loan_taken extends Model
{
    
    public function wallet()
    {
        return $this->belongTo('App\Models\Wallet', 'wallet_key', 'wallet_key');
    }
}
