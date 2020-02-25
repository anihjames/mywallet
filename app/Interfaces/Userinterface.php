<?php

namespace App\Interfaces;

interface Userinterface
{
    public function create();
    public function update();
    public function getTransactions($key);
    public function gettopup($key);
    public function getBills($key);
    public function logUser();
    public function userlevel();
}