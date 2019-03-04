<?php

namespace App\Providers;

use App\Service\CartService;
use App\Service\AccountService;
use App\Service\ItemService;
use App\Service\CheckoutService;
use App\Service\PaypalService;
use App\Service\FoundationService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CommerceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            ['includes.header', '/order/cart-details'], 'App\Http\ViewComposers\CartComposer'
        );

        View::composer(
            ['includes.dept-sidebar'], 'App\Http\ViewComposers\DeptComposer'
        );
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Service\CartServiceInterface', function () {
            return new CartService();
        });

        $this->app->singleton('App\Service\AccountServiceInterface', function () {
            return new AccountService();
        });

        $this->app->singleton('App\Service\ItemServiceInterface', function () {
            return new ItemService();
        });

        $this->app->singleton('App\Service\FoundationServiceInterface', function () {
            return new FoundationService();
        });

        $this->app->singleton('App\Service\CheckoutServiceInterface', function () {
            return new CheckoutService();
        });

        $this->app->singleton('App\Service\PaypalServiceInterface', function () {
            return new PaypalService();
        });
    }
}
