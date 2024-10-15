<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
        Paginator::useBootstrapFive();
        Str::macro('initials', fn($value, $sep = ' ', $glue = ' ') => trim(collect(explode($sep, $value))
            ->map(function ($segment) {
            return $segment[0] ?? '';
        })->join($glue)));
    }
}
