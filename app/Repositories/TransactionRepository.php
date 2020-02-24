<?php

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepository
{
    protected $transactions;

    public function __construct(Transaction $transaction)
    {
        $this->transactions = $transaction;
    }

    public function create($data)
    {

    }

    public function find($id)
    {
       return $this->transactions->find($id);
    }

    public function findbykey($key)
    {
        return $this->transactions->where('wallet_key', $key)->limit(5)->orderBy('created_at', 'desc')->get();
    }

    public function update($id, array $data)
    {
        return $this->transactions->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->transactions->find($id)->delete();
    }



}

