<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.instructor')]
class InstructorGradeIndex extends Component
{
    public function render()
    {
        return view('livewire.instructor-grade-index');
    }
}
