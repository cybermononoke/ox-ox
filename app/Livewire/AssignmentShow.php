<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Assignment;

class AssignmentShow extends Component
{
    public $assignment;

    public function mount($assignmentId)
    {
        $this->assignment = Assignment::findOrFail($assignmentId);
    }

    public function render()
    {
        return view('livewire.assignment-show');
    }
}
