<?php

namespace App\Livewire;

use App\Models\AssignmentSubmission;
use Livewire\Component;

class GradeAssignment extends Component
{
    public $submission;
    public $grade;

    public function mount(AssignmentSubmission $submission)
    {
        $this->submission = $submission;
        $this->grade = $submission->grade;
    }

    public function grade()
    {
        $this->validate([
            'grade' => 'required|integer|between:0,' . $this->submission->assignment->max_points,
        ]);

        $this->submission->update([
            'grade' => $this->grade,
        ]);

        $this->submission->assignment->update(['graded' => true]);

        session()->flash('message', 'Grade assigned successfully!');
    }

    public function render()
    {
        return view('livewire.grade-assignment');
    }
}