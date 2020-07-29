<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AccountService;

class AccountServiceProvider extends ServiceProvider
{
    public function register()
    {
        # make dependecy tree here
        $this->app->singleton(AccountService::class, function($app) {
            // $account = new AccountService();
            // $account->request = $this->app->request;
            return new AccountService();
        });
    }

    public function boot() # inject response
    {
        //
    }
}