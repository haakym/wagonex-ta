<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddCityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Add a new city using the API /api/city endpoint.
     *
     * @return void
     */
    public function testAddACity(): void
    {
        // arrange
        $city = City::factory()->make();
        
        // act
        $response = $this->postJson('/api/city', [
            'name' => $city->name,
            'latitude' => $city->latitude,
            'longitude' => $city->longitude,
        ]);

        // assert
        $response->assertStatus(200);
        $response->assertJson([
            'name' => $city->name,
            'latitude' => $city->latitude,
            'longitude' => $city->longitude,
        ]);
    }

    public function testFailsToAddWithoutRequiredFields(): void
    {
        $response = $this->postJson('/api/city', []);
        $response->assertStatus(422);
    }
}
