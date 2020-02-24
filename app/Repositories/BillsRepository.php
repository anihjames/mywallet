<?php

namespace App\Repositories;

use App\Models\Bill_payment;

class BillsRepository
{
    protected $bills;

    public function __construct(Bill_payment $bill_payment)
    {
        $this->bills = $bill_payment;
    }

    public function create($data)
    {

    }

    public function find($id)
    {
        return $this->bills->find($id);
    }

    public function findbykey($key)
    {
        return $this->bills->where('wallet_key', $key)->orderBy('created_at', 'desc')->get();

    }

    public function getbills()
    {
        return $this->bills->join('wallets', 'wallets.wallet_key', '=', 'bill_payments.wallet_key')
                                ->join('users', 'users.id', '=', 'wallets.user_id')
                                ->select('bill_payments.id','bill_payments.payment_pid', 'bill_payments.bills_type', 'bill_payments.bills_amount', 'bill_payments.type_code', 'bill_payments.created_at', 'bill_payments.status', 'users.fname', 'users.lname', 'users.email', 'users.phone')
                                ->orderBy('created_at', 'desc');
    }

    public function update($id, array $data)
    {

    }

    

    public function delete($id)
    {
        
    }
}