<?php

namespace App\Interfaces;

interface Userinterface
{
    public function create();
    public function update($key);
    public function getTransactions($key);
    public function gettopup($key);
    public function getBills($key);
    public function logUser();
    public function userlevel();
    public function walletdetails();
    public function updateWallet($key, array $attributes);
    public function notify($key, $message);
    public function allnotify($key);
    public function getunreadnotifiy($key);
    public function updatenotify($id);
    public function notifyadmin($data);
    public function applyforloan();
    public function payloan($loanpid);
    
}