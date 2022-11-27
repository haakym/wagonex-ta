<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetFiveDayForecastTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @testdox Get the five day forecast for a city.
     *
     * @return void
     */
    public function testGetFiveDayForeCastForACity(): void
    {
        // arrange
        $city = City::factory()->create([
            'name' => 'London',
            'latitude' => '51.500153',
            'longitude' => '-0.1262362',
        ]);
        
        // act
        $response = $this->getJson("/api/weather/{$city->id}");

        // assert
        $response->assertStatus(200);
            // ->assertJsonStructure([
            //     'id', 'name', 'latitude', 'longitude'
            // ]);
    }
    
    /**
     * Get the five day forecast for all cities.
     *
     * @return void
     */
    public function testGetFiveDayForeCastForAllCities(): void
    {
        // arrange
        City::factory()->create([
            'name' => 'London',
            'latitude' => '51.500153',
            'longitude' => '-0.1262362',
        ]);
        City::factory()->create([
            'name' => 'Cardiff',
            'latitude' => '51.48167',
            'longitude' => '-3.17917',
        ]);
        City::factory()->create([
            'name' => 'Edinburgh',
            'latitude' => '55.95333',
            'longitude' => '-3.18917',
        ]);
        
        // act
        $response = $this->getJson('/api/weather');

        // assert
        $response->assertStatus(200);
    }
}
