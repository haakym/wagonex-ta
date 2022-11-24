<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetFiveDayForecastTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * Get the five day forecast for a city.
     *
     * @return void
     */
    public function testGetFiveDayForeCastForACity()
    {
        // arrange
        $city = City::factory()->create();
        
        // act
        $response = $this->getJson("/api/weather/{$city->id}");

        // assert
        $response->assertStatus(200);
    }
}
