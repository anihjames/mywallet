<?php

namespace App\Services;

//use App\Models\Bill_payment;
use App\Repositories\BillsRepository;
use Illuminate\Http\Request;

class BillService
{
    protected $bills;

    public function __construct(BillsRepository $bills_payment)
    {
        $this->bills = $bills_payment;
    }

    public function create()
    {

    }

    public function readbyKey($key)
    {
        return $this->bills->findbykey($key);
    }

    public function getbills()
    {
        return $this->bills->getbills();
    }
}