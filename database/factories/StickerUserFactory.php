<?php

namespace Database\Factories;

use App\Models\Sticker;
use App\Models\StickerUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class StickerUserFactory extends Factory
{
    protected $model = StickerUser::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_id' => User::inRandomOrder()->first(),
            'sticker_id' => Sticker::inRandomOrder()->first(),
        ];
    }
}
