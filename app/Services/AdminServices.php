<?php

namespace App\Services;

use App\Repositories\AdminRepository;
use Illuminate\Http\Request;

class AdminServices
{
    protected $admin;

    public function __construct(AdminRepository $adminrepo)
    {
        $this->admin = $adminrepo;
    }

    public function gettopups()
    {
        return $this->admin->getTopups();

    }

    public function getbills()
    {
        return $this->admin->getBills();
    }

    public function getloans()
    {
        return $this->admin->getLoans();
    }

    public function getTransactions()
    {
        return $this->admin->getTransactions();
    }
}