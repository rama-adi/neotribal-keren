<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Livewire\Component;
use Str;

class BuyCoin extends Component
{
    public $COIN_PACKAGES = [
        '100' => 20000,
        '500' => 90000,
        '1000' => 150000,
        '3000' => 500000,
    ];

    public $paying = false;
    public Transaction $transaction;

    public function buyCoin($amount)
    {
        $selectedAmount = $this->COIN_PACKAGES[$amount];

        $this->transaction = Transaction::create([
            'user_id' => auth()->user()->id,
            'coins' => (int)$amount,
            'status' => 'pending',
            'amount' => $selectedAmount,
            'description' => 'Membeli ' . $amount . ' coins',
            'code' => auth()->user()->id . 'TX' . strtoupper(Str::random(6)),
        ]);

        $this->paying = true;


    }

    public function render()
    {
        return view('livewire.buy-coin');
    }
}
