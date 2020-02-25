<?php

namespace App\Repositories;

use App\Models\Loan;
use Auth;
use App\Interfaces\Loaninterface;

class LoanRepository implements Loaninterface
{
    protected $loan;

    public function create()
    {

    }

    public function rate($userlevel)
    {
        return Loan::where('loan_level', $userlevel)->value('interest_rate');
    }
}