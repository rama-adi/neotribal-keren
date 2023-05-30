<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\LocationUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class LocationUserFactory extends Factory
{
    protected $model = LocationUser::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first(),
            'location_id' => Location::inRandomOrder()->first(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
