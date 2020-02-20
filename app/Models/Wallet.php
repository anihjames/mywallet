<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = ['user_id', 'wallet_key', 'wallet_balance', 'credit_total', 'debit_total', 'loan_taken_amount','loan_amount_left', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function billpayment()
    {
        return $this->hasMany('App\Models\Bill_payment');
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction', 'wallet_key');
    }

    public function topups()
    {
        return $this->hasMany('App\Mobels\MobileTopup');
    }

}
