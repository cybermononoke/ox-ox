<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Assignment;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.instructor')]
class InstructorAssignmentShow extends Component
{

    public $assignment;

    public function mount($assignmentId)
    {
        $this->assignment = Assignment::findOrFail($assignmentId);
    }


    public function render()
    {
        return view('livewire.instructor-assignment-show');
    }
}
