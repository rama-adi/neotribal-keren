<?php

namespace App\Http\Livewire;

use App\Models\Location;
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
        auth()->user()->locations()->attach($this->selectedExperience->id);
        $this->unsoldExperiences = Location::whereDoesntHave('users', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();
        $this->page = 'listing';
    }


    public function render()
    {
        return view('livewire.buy-experience');
    }
}
