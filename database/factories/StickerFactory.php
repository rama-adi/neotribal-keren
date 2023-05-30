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
        $filepath = storage_path('sticker-photo');

        if (!File::exists($filepath)) {
            File::makeDirectory($filepath);
        }

        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'photo' => $this->faker->image($filepath, 100, 100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
