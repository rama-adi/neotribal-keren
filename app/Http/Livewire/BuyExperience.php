<?php

namespace App\Http\Livewire;

use App\Models\Location;
use App\Models\Transaction;
use DB;
use Illuminate\Support\Str;
use Livewire\Component;

class BuyExperience extends Component
{
    /** @var Location[] $unsoldExperiences */
    public $unsoldExperiences;

    /** @var Location $selectedExperience */
    public $selectedExperience;
    public $page = 'listing';

    public function mount()
    {
        $this->unsoldExperiences = Location::whereDoesntHave('users', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();

        $this->selectedExperience = $this->unsoldExperiences[1];
    }

    public function selectOne($index)
    {
        $this->selectedExperience = $this->unsoldExperiences[$index];
        $this->page = 'single';
    }

    public function buyExperience()
    {

        if (auth()->user()->coins >= $this->selectedExperience->coins) {

            DB::transaction(function () {
                auth()->user()->locations()->attach($this->selectedExperience->id);
                auth()->user()->decrement('coins', $this->selectedExperience->coins);
                Transaction::create([
                    'user_id' => auth()->id(),
                    'code' => auth()->id() . "-AUTOCOMPLETE-EXPROBOT-" . strtoupper(Str::random(10)),
                    'amount' => $this->selectedExperience->coins,
                    'description' => 'Bought ' . $this->selectedExperience->name . ' experience (NO APPROVAL NEEDED)',
                    'status' => 'completed'
                ]);
            });


            $this->unsoldExperiences = Location::whereDoesntHave('users', function ($query) {
                $query->where('user_id', auth()->id());
            })->get();

            $this->page = 'listing';
        }


    }


    public function render()
    {
        return view('livewire.buy-experience');
    }
}
