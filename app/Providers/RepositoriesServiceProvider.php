<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\LoanRepository;
use App\Interfaces\Loaninterface;
use App\Repositories\UserRepository;
use App\Interfaces\Userinterface;

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

       
    }

    public function registerLoanRepo()
    {
        return  $this->app->bind(Loaninterface::class, LoanRepository::class);
    }

    public function registerUserRepo()
    {
        $this->app->bind(Userinterface::class, UserRepository::class);
    }
}
