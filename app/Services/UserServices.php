<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Auth;

class UserServices
{
    protected $user;

    public function __construct(UserRepository $userRepo)
    {
        $this->user = $userRepo;
    }

    public function getTransactions($key)
    {
        return $this->user->getTransactions($key);
    }

    public function topups($key)
    {
        return $this->user->gettopup($key);
    }

    public function bills($key)
    {
        return $this->user->getbills($key);
    }

    public function notifications()
    {
        $notifications = auth()->user()->notifications()->orderBy('created_at','desc')->get()->toArray();
    }

    
}