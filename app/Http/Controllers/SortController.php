<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;
use App\User;
use App\Models\Transaction;
use App\Models\Wallet;

class SortController extends Controller
{
  
    public function getusertrans($id)
    {
        $user = User::find($id)->wallet;
        $wallet_key = $user->wallet_key;

        $trans = Transaction::where('wallet_key', $wallet_key)->get();

        return view('modals.usertrans');
        
    }
}
