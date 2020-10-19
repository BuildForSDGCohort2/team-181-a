<?php

namespace App\Providers;

use App\Isues;
use App\Observers\IssuesObserver;
use App\Observers\OrderObserver;
use App\Order;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Order::observe(OrderObserver::class);
        Isues::observe(IssuesObserver::class);
    }
}
