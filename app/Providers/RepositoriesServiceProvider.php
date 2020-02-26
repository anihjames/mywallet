<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\LoanRepository;
use App\Interfaces\Loaninterface;
use App\Repositories\UserRepository;
use App\Interfaces\Userinterface;
use App\Interfaces\Transactioninterface;
use App\Repositories\TransactionRepository;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerLoanRepo();
        $this->registerUserRepo();
        $this->registerTransaction();

       
    }

    public function registerLoanRepo()
    {
        return  $this->app->bind(Loaninterface::class, LoanRepository::class);
    }

    public function registerUserRepo()
    {
        $this->app->bind(Userinterface::class, UserRepository::class);
    }

    public function registerTransaction()
    {
        $this->app->bind(Transactioninterface::class, TransactionRepository::class);
    }
}
