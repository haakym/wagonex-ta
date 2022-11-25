<?php

namespace App\Weather\Services;

use App\Models\City;
use App\Weather\ValueObjects\FiveDayForecast;
use App\Weather\Repositories\OpenWeatherApiRepository;

class ForecastService
{
    public function __construct(
        private OpenWeatherApiRepository $openWeatherApiRepository,
        private City $city
    ) {
    }

    /**
     * Find city by id and call API using city's latitude and longitude.
     * 
     * @return todo
     */
    public function getFiveDayForecastForCityById(int $id) // todo
    {
        $city = $this->city->find($id);

        $response = $this->openWeatherApiRepository->getFiveDayForecast($city->latitude, $city->longitude);

        return $response->json();
    }
}
