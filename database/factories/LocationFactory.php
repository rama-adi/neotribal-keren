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

        $filepath = storage_path('app/public/location-photo');

        if (!File::exists($filepath)) {
            File::makeDirectory($filepath);
        }

        $image = $this->faker->image($filepath, 1080, 1920);
        $segments = explode('/', $image); // Split the string into an array using the forward slash as the delimiter
        $index = array_search('location-photo', $segments); // Find the index of the "neotribal" segment
        $result = implode('/', array_slice($segments, $index + 1)); // Extract everything after the "neotribal" segment
        $result = 'location-photo/' . $result;

        return [
            'name' => $this->faker->city,
            'description' => $this->faker->paragraph,
            'photo' => $result,
            'created_at' => Carbon::now(),
            'coins' => $this->faker->numberBetween(10, 100),
            'updated_at' => Carbon::now(),

        ];
    }
}
