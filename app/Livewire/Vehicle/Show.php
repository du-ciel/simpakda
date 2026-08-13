<?php

namespace App\Livewire\Vehicle;

use App\Models\Vehicle;
use Livewire\Component;

class Show extends Component
{
    public Vehicle $vehicle;

    public function mount(Vehicle $vehicle): void
    {
        $this->vehicle = $vehicle->load('histories.user');
    }

    public function render()
    {
        return view('livewire.vehicle.show');
    }
}
