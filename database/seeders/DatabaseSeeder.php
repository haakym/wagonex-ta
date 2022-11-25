<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\City;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
