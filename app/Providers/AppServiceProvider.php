<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;
use App\Services\CurrencyConversionService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register GuzzleHttp Client singleton for communicating with ExchangeRate-API
        $this->app->singleton(Client::class, function ($app) {
            return new Client([
                // The API key comes from EXCHANGE_RATE_API_KEY in .env
                'base_uri' => 'https://v6.exchangerate-api.com/v6/' . config('services.exchange_rate.key') . '/',
                'timeout'  => 2.0,
                'verify' => base_path('certificates/cacert.pem'),
            ]);
        });

        // Register CurrencyConversionService singleton with GuzzleHttp Client dependency
        $this->app->singleton(CurrencyConversionService::class, function ($app) {
            return new CurrencyConversionService($app->make(Client::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
