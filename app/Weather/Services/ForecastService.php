<?php

namespace App\Weather\Services;

use App\Models\City;
use App\Weather\ValueObjects\FiveDayForecast;
use App\Weather\Repositories\OpenWeatherApiRepository;
use Illuminate\Support\Facades\Cache;

class ForecastService
{
    public function __construct(
        private OpenWeatherApiRepository $openWeatherApiRepository,
        private City $city
    ) {
    }

    /**
     * Get the five day forecast for a city using the open weather API or a 
     * cached result. Cached results are stored for one hour (3600 seconds).
     * 
     * @return todo
     */
    public function getFiveDayForecastForCity(City $city) // todo
    {
        $forecastCacheKey = "forecast_city_id:{$city->id}";

        if (Cache::has($forecastCacheKey)) {
            $forecast = Cache::get($forecastCacheKey);
        } else {
            $response = $this->openWeatherApiRepository->getFiveDayForecast($city->latitude, $city->longitude);
            $forecast = $response->json();
            Cache::put($forecastCacheKey, $forecast, 3600);
        }

        return $forecast;
    }

    /**
     * 
     * @return array
     */
    public function getFiveDayForecastForCities(int $offset, int $limit): array
    {
        $cities = $this->city->offset($offset)->limit($limit)->get();

        $forecasts = [];
        foreach ($cities as $city) {
            $forecasts[] = $this->getFiveDayForecastForCity($city);
        }

        return $forecasts;
    }
}
