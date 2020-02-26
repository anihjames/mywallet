<?php

namespace App\Repositories;

use App\Models\Loan;
use App\Models\Take_loan;
use Auth;
use App\Interfaces\Loaninterface;
use Carbon\Carbon;

class LoanRepository implements Loaninterface
{

    public function create($attributes)
    {

        $dt = carbon::now();

        return  Take_loan::create([
                'wallet_key'=> $attributes['wallet_key'],
                'loan_pid'=> $attributes['loan_pid'],
                'loan_amount'=> $attributes['loanrequest']['loan_amount'],
                'loan_app_date'=> $dt->isoFormat('dddd D, Y'),
                'loan_length'=> $attributes['loanrequest']['loan_tenure'] .' '.'months',
                'userincome'=> $attributes['loanrequest']['userincome'],
                'repayment_amount'=> $attributes['loanrequest']['repayment_amount'],
                'verified'=> 1,
                'expiration_date'=> $dt->addMonths($attributes['loanrequest']['loan_tenure']),
            ]);
    }

    public function rate($userlevel)
    {
        return Loan::where('loan_level', $userlevel)->select(['interest_rate','tenure', 'loan_amount'])->first();
    }

    public function all()
    {

    }

    public function outstandingloans($key)
    {
        return Take_laon::where('wallet_key', $key)->get();
    }

    public function getloan($pid)
    {
        return Take_loan::where('loan_pid', $pid)->select('loan_amount', 'loan_length', 'repayment_amount', 'expiration_date')->first();
    }

    public function delete($id)
    {
        return Take_loan::find($id)->delete();
    }
}