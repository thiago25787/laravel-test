<?php

namespace App\Providers;

use App\Repositories\AccountRepository;
use App\Repositories\AccountRepositoryEloquent;
use App\Repositories\DepositRepository;
use App\Repositories\DepositRepositoryEloquent;
use App\Repositories\PurchaseRepository;
use App\Repositories\PurchaseRepositoryEloquent;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(AccountRepository::class, AccountRepositoryEloquent::class);
        $this->app->bind(DepositRepository::class, DepositRepositoryEloquent::class);
        $this->app->bind(PurchaseRepository::class, PurchaseRepositoryEloquent::class);
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
