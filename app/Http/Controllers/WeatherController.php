<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Weather\Services\ForecastService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function __construct(
        private ForecastService $forecastService
    ) {
    }

    /**
     * Get five day weather forecast for all cities in the database. Results are
     * limited by default but may be overridden using the offset and limit query
     * parameters.
     * 
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $offset = $request->get('offset', 0);
        $limit = $request->get('limit', $offset + 25);

        $forecasts = $this->forecastService->getFiveDayForecastForCities($offset, $limit);

        return response()->json($forecasts);
    }

    /**
     * Get five day weather forecast for a city.
     * 
     * @return JsonResponse
     */
    public function show(City $city): JsonResponse
    {
        $forecast = $this->forecastService->getFiveDayForecastForCity($city);

        return response()->json($forecast);
    }
}
