<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DesktopExperienceView extends ModalComponent
{
    public Location $location;

    public function render()
    {
        return view('livewire.desktop-experience-view');
    }
}
