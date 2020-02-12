<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Take_loan extends Model
{
    protected $fillable = ['loan_pid', 'loan_amount', 'loan_app_date', 'loan_length', 'wallet_key'];
}
