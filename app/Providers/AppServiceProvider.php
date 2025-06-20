<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Wishlist;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        Validator::extend('mobile', function ($attribute, $value, $parameters, $validator) {
            // Use a regular expression to validate the mobile number format
            return preg_match('/^\d{11}$/', $value);
        });

        // Add this block to share wishlist count with all views
        View::composer('*', function ($view) {
            $wishlistCount = 0;

            if (auth()->check()) {
                $wishlistCount = Wishlist::where('user_id', auth()->id())->count();
            }

            $view->with('wishlist_count_total', $wishlistCount);
        });
    }
}
