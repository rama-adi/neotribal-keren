<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Location;
use App\Models\LocationStar;
use App\Models\LocationUser;
use App\Models\Sticker;
use App\Models\StickerUser;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Location::factory(10)->create();

        Location::all()->each(function ($location) {
            LocationStar::factory(5)->create([
                'location_id' => $location->id,
            ]);

            LocationUser::factory(5)->create([
                'location_id' => $location->id,
                'user_id' => $location->id
            ]);
        });

        Sticker::factory(10)->create()->each(function ($sticker) {
           StickerUser::factory()->create([
                'sticker_id' => $sticker->id,
                'user_id' => $sticker->id
           ]);
        });

        User::all()->each(function ($user) {
            $rand_tx_amount = rand(1, 10);
            Transaction::factory($rand_tx_amount)->create([
                'user_id' => $user->id
            ]);
        });

        User::all()->each(function ($user) {
            $user->coins = $user->transactions->sum('coin');
            $user->save();
        });



        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
