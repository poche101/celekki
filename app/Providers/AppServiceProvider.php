<?php

namespace App\Providers;

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
    if (app()->environment('local')) {
        // Force the Analytics package to use a non-verifying Guzzle client
        $this->app->when(\Spatie\Analytics\AnalyticsClientFactory::class)
            ->needs(\GuzzleHttp\Client::class)
            ->give(function () {
                return new \GuzzleHttp\Client([
                    'verify' => false,
                ]);
            });

        // Also force the general Guzzle client just in case
        $this->app->bind(\GuzzleHttp\Client::class, function () {
            return new \GuzzleHttp\Client(['verify' => false]);
        });
    }
}
}
