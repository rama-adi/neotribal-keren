<?php

namespace Database\Factories;

use App\Models\Sticker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class StickerFactory extends Factory
{
    protected $model = Sticker::class;

    public function definition(): array
    {
        $filepath = storage_path('app/public/sticker-photo');

        if (!File::exists($filepath)) {
            File::makeDirectory($filepath);
        }

        $image = $this->faker->image($filepath, 100, 100);
        $segments = explode('/', $image); // Split the string into an array using the forward slash as the delimiter
        $index = array_search('sticker-photo', $segments); // Find the index of the "neotribal" segment
        $result = implode('/', array_slice($segments, $index + 1)); // Extract everything after the "neotribal" segment
        $result = 'sticker-photo/' . $result;

        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'photo' => $result,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
