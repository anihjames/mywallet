<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use DB;

class DashboardController extends Controller
{
    
    public function index()
    {
        return view('dashboard.home');
    }

    public function viewbills()
    {
        $bills = Cache::get('bills', function () {
            return DB::table('bills')->get();
        });
        //dd($bills);
        return view('dashboard.payBills', ['bills'=> $bills]);
    }

    public function getbilltype($bill_id)
    {
        $bills_type = DB::table('bill_types')->where('bill_id', $bill_id)->get();
        dd($bills_type);
    }
}
