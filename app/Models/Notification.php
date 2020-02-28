<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'wallet_key','message','notify_id'
    ];

    public function wallet()
    {
        return $this->belongTo('App\Models\Wallet', 'wallet_key', 'wallet_key');
    }
}
