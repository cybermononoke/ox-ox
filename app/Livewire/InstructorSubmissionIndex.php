<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AssignmentSubmission;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.instructor')]
class InstructorSubmissionIndex extends Component
{
    public function render()
    {
        $submissions = AssignmentSubmission::with(['assignment', 'student'])->get();

        return view('livewire.instructor-submission-index', [
            'submissions' => $submissions,
        ]);
    }
}
