<?php

namespace App\Providers;

use App\Models\City;
use Illuminate\Support\ServiceProvider;
use App\Weather\Services\ForecastService;
use App\Weather\Repositories\OpenWeatherApiRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(OpenWeatherApiRepository::class, function ($app) {
            $baseUrl = 'https://api.openweathermap.org/data/2.5/';
            $openWeatherApiAppId = env('OPEN_WEATHER_API_APP_ID');
            return new OpenWeatherApiRepository(
                $baseUrl,
                $openWeatherApiAppId
            );
        });
        
        $this->app->bind(ForecastService::class, function ($app) {
            return new ForecastService(
                $app->make(OpenWeatherApiRepository::class),
                new City()
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
