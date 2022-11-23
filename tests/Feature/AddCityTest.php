<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddCityTest extends TestCase
{
    /**
     * Add a new city.
     *
     * @return void
     */
    public function testAddACity()
    {
        $response = $this->post('/api/city', [
          'name' => 'London, UK'
        ]);

        $response->assertStatus(200);
    }
}
