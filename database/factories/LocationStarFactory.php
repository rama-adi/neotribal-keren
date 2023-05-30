<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\LocationStar;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class LocationStarFactory extends Factory
{
    protected $model = LocationStar::class;

    public function definition(): array
    {
        return [
            'left_offset' => $this->faker->numberBetween(0, 100),
            'top_offset' => $this->faker->numberBetween(0, 100),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'location_id' => Location::factory(),
        ];
    }
}
