<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Interfaces\Transactioninterface;

class TransactionRepository implements Transactioninterface 
{
    
    public function create($attributes)
    {
       
        return Transaction::create([
            'trans_type'=> $attributes['trans_type'],
            'wallet_key'=> $attributes['loans']['wallet_key'],
            'trans_status'=> $attributes['loans']['verified'],
            'trans_name'=> $attributes['trans_name'],
            'trans_amount'=> $attributes['loans']['loan_amount'],
            'balance'=> $attributes['newbalance'],
            'trans_pid'=> $attributes['loans']['loan_pid'],
        ]);
    }

    // public function find($id)
    // {
    //    return $this->transactions->find($id);
    // }

    // public function findbykey($key)
    // {
    //     return $this->transactions->where('wallet_key', $key)->limit(5)->orderBy('created_at', 'desc')->get();
    // }

    // public function update($id, array $data)
    // {
    //     return $this->transactions->find($id)->update($data);
    // }

    // public function delete($id)
    // {
    //     return $this->transactions->find($id)->delete();
    // }



}

