<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Services\TransactionService;
use Yajra\Datatables\Datatables;


class SortController extends Controller
{

    protected $transactionservice;
  
    public function __construct(TransactionService $transactionservice)
    {
        $this->transactionservice = $transactionservice;
    }

    public function getusertrans($id)
    {
        $user = User::find($id)->wallet;
        $wallet_key = $user->wallet_key;

        $trans = $this->transactionservice->readbykey($wallet_key);

        return view('modals.usertrans')->with('trans',$trans);
    }

    public function usertransdetails($id)
    {
        

        return Datatables::of($trans)
                        ->addcolumn('status', function($tran) {
                            if($tran->trans_status == '0') {
                                return 'Failed';
                            }elseif($tran->trans_status == '1'){
                                return 'Pending';
                            }elseif($tran->trans_status == '2'){
                                return 'successful';
                            }
                        })
                        ->make(true);
    }
}
