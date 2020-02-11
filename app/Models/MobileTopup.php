<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MobileTopup extends Model
{
    protected $fillable = ['mobile_number','network_provider', 'amount', 'wallet_key', 'country_code' , 'status', 'dataplan', 'toptype','created_at', 'updated_at', 'mobile_pid'];

    public function wallet()
    {
        return $this->belongTo('App\Models\Wallet', 'wallet_key', 'wallet_key');
    }
}
