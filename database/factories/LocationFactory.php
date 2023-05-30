<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class LocationFactory extends Factory
{
    protected $model = Location::class;

    public function definition(): array
    {

        $filepath = storage_path('location-photo');

        if (!File::exists($filepath)) {
            File::makeDirectory($filepath);
        }

        return [
            'name' => $this->faker->city,
            'description' => $this->faker->paragraph,
            'photo' => $this->faker->image($filepath, 1080, 1920 ),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ];
    }
}
