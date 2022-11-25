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
     * Call OpenWeather API to get the five day forecast for a city using 
     * latitude and longitude.
     */
    public function getFiveDayForecast($latitude, $longitude): Response
    {
        $queryParams = [
            'appid' => $this->appId,
            'lat' => $latitude,
            'lon' => $longitude,
            'cnt' => 5,
        ];

        $response = Http::get("{$this->baseUrl}/forecast/", $queryParams);

        if (!$response->successful()) {
            // throw/handle exception
        }

        return $response;
    }
}
