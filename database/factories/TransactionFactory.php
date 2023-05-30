<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        $randomNumber = $this->faker->numberBetween(-100, 100);
        $payAmount = 0;

        if ($randomNumber > 0) {
            $description = 'Membeli koin ' . $randomNumber . ' koin';
            $payAmount = $randomNumber * 1000;
        } else {
            $description = 'Menggunakan Koin ' . abs($randomNumber) . ' koin';
            $payAmount = 0;
        }

        return [
            'coins' => $randomNumber,
            'code' => strtoupper(Str::random(15)),
            'status' => $this->faker->randomElement(['pending', 'completed', 'failed']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'description' => $description,
            'amount' => $payAmount,
            'user_id' => User::factory(),
        ];
    }
}
