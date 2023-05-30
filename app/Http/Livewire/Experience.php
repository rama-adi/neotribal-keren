<?php

namespace App\Http\Livewire;

use App\Models\Location;
use App\Models\LocationStar;
use Livewire\Component;

class Experience extends Component
{
    public Location $location;
    public $currentPage = 'tutorial';

    public $mode = 'mobile';

    /**@var LocationStar[] $locationStars */
    public $locationStars = [];

    public LocationStar $selectedStar;

    protected $queryString = [
        'mode' => ['except' => 'mobile'],
    ];

    public function mount(): void
    {
        if (auth()->user()->locationUsers()->whereLocationId($this->location->id)->doesntExist()) {
            $this->redirect(route('dashboard'));
        }
    }

    public function startGame()
    {
        $this->currentPage = 'game';
        $this->locationStars = $this->location->locationStar()->get();
    }

    public function backToGame()
    {
        $this->currentPage = 'game';
    }

    public function explainStar($index)
    {
        $this->selectedStar = $this->locationStars[$index];
        $this->currentPage = 'explain';
    }

    public function render()
    {
        return view('livewire.experience')
            ->layout('components.empty-layout');
    }
}
