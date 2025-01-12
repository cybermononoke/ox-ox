<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.empty')]
#[Title('Home')]

class Home extends Component
{
    public function render()
    {
        return view('livewire.home');
    }
}
