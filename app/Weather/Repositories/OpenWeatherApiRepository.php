<?php

namespace App\Weather\Repositories;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class OpenWeatherApiRepository
{
    public function __construct(
        private string $baseUrl,
        private string $appId
    ) {
    }

    /**
     * API URL to retrieve the daily forecast.
     * 
     * @return string
     */
    private function getDailyForecastURL(): string
    {
        // return "{$this->baseUrl}/forecast/daily"; // not working?!
        return "{$this->baseUrl}/forecast";
    }

    /**
     * Call OpenWeather API to get the five day forecast for a city using 
     * latitude and longitude.
     * 
     * @return Response
     */
    public function getFiveDayForecast($latitude, $longitude): Response
    {
        $queryParams = [
            'appid' => $this->appId,
            'lat' => $latitude,
            'lon' => $longitude,
            'cnt' => 5,
        ];

        $response = Http::get($this->getDailyForecastURL(), $queryParams);

        if (!$response->successful()) {
            // throw/handle exception
        }

        return $response;
    }
}
