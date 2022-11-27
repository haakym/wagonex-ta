<?php

namespace App\Weather\ValueObjects;

use App\Models\City;

class FiveDayForecast
{
    // public function __construct(
    //     private string $city,
    //     private array $forecasts
    // ){}

    public static function make(City $city, array $forecastData): array
    {
        $fiveDayForecast = [];
        $fiveDayForecast['id'] = $city->id;
        $fiveDayForecast['city'] = $city->name;
        foreach($forecastData['list'] as $dayForecast) {
            $fiveDayForecast['forecasts'][] = [
                'date' => date("H:i M jS", $dayForecast['dt']),
                'summary' => $dayForecast['weather'][0]['main'],
                'icon' => "http://openweathermap.org/img/wn/{$dayForecast['weather'][0]['icon']}.png",
            ];
        }
        
        return $fiveDayForecast;
    }
}
