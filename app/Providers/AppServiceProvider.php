<?php

namespace App\Providers;

use App\Http\Resources\CartResource;
use App\Http\Resources\CommentResource;
use App\Http\Resources\OrderResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrapFive();
        CartResource::withoutWrapping();
        OrderResource::withoutWrapping();
        CommentResource::withoutWrapping();
    }
}
