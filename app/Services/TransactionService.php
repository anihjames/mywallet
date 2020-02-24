<?php

namespace App\Services;

use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class TransactionService
{
    protected $transactions;

    public function __construct(TransactionRepository $transaction)
    {
        $this->transactions = $transaction;
    }

    public function create()
    {

    }

    public function readbykey($key)
    {
        return $this->transactions->findbykey($key);
    }


}
