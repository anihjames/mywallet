<?php

namespace App\Repositories;


use App\User;
use App\Models\Wallet;
use DB;
use Auth;
use App\Interfaces\Userinterface;

class UserRepository implements Userinterface
{
    protected $userdata;

    public function create()
    {

    }

    public function logUser()
    {
        return Auth::user();
    }

    public function userlevel()
    {
        return $this->logUser()->level;
    }

    public function update($id)
    {

    }

    public function getTransactions($key)
    {
        return Wallet::where('wallet_key', $key)->first()->transactions;
       
    }

    public function gettopup($key)
    {
        return Wallet::where('wallet_key', $key)->first()->topups;
       
    }

    public function getBills($key)
    {
        return Wallet::where('wallet_key', $key)->first()->billpayments;
       
    }

    

    public function walletdetails()
    {
        $id = $this->logUser()->id;
        return User::find($id)->wallet;
    }

    public function updateWallet($key, array $attributes)
    {
        return Wallet::where('wallet_key', $key)->update($attributes);
    }

    public function notify($key,$message)
    {
        return DB::table('notifications')->insert([
            'wallet_key'=> $key,
            'message'=> $message,
            'read'=> 0,
        ]);
    }
    public function allnotify($key)
    {
        return DB::table('notifications')
                        ->where('wallet_key', $key)
                        ->orderBy('created_at','desc')
                        ->select('message', 'read');
    }
    public function getunreadnotifiy($key)
    {
        return DB::table('notifications')
                        ->where('wallet_key', $key)
                        ->where('read', '0')
                        ->limit(5)
                        ->orderBy('created_at','desc')
                        ->select('message', 'read');
    }

    public function notifyadmin($data)
    {
        return DB::table('adminnotifications')->insert($data);
    }
    
    public function updatenotify($id)
    {
        return DB::table('notifications')->where('id', $id)->update([
            'read'=> 1,
        ]);
    }

    
}