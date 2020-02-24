<?php

namespace App\Repositories;

use DB;

class AdminRepository
{
    protected $admin;

    public function getTopups()
    {
        $topups = DB::table('mobile_topups')
                        ->join('wallets', 'wallets.wallet_key', '=', 'mobile_topups.wallet_key')
                        ->join('users', 'users.id', '=', 'wallets.user_id')
                        ->select('mobile_topups.id','mobile_topups.toptype','mobile_topups.mobile_number','mobile_topups.network_provider', 'mobile_topups.amount', 'mobile_topups.status','mobile_topups.mobile_pid', 'mobile_topups.created_at', 'users.fname', 'users.lname')
                        ->orderBy('created_at', 'desc');
                        
        return $topups;

    }

    public function getTransactions()
    {
        $trans = DB::table('transactions')->select(['trans_pid', 'trans_type', 'trans_name', 'trans_amount','balance', 'trans_status', 'created_at'])
                                ->orderBy('created_at', 'desc');

        return $trans;
    }

    public function getBills()
    {
        $bills = DB::table('bill_payments')
                        ->join('wallets', 'wallets.wallet_key', '=', 'bill_payments.wallet_key')
                        ->join('users', 'users.id', '=', 'wallets.user_id')
                        ->select('bill_payments.id','bill_payments.payment_pid', 'bill_payments.bills_type', 'bill_payments.bills_amount', 'bill_payments.type_code', 'bill_payments.created_at', 'bill_payments.status', 'users.fname', 'users.lname', 'users.email', 'users.phone')
                        ->orderBy('created_at', 'desc');

        return $bills;


    }

    public function getLoans()
    {
        $loans = DB::table('take_loans')
                    ->join('wallets', 'wallets.wallet_key', '=', 'take_loans.wallet_key')
                    ->join('users', 'users.id', '=', 'wallets.user_id')
                    ->select('take_loans.id','take_loans.loan_pid','take_loans.loan_amount','take_loans.loan_length', 'take_loans.verified', 'take_loans.created_at', 'users.fname', 'users.lname')
                    ->orderBy('created_at','desc');
        return $loans;

    }
}
