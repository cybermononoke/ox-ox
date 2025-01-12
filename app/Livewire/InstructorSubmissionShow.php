<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AssignmentSubmission;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.instructor')]
class InstructorSubmissionShow extends Component
{
    public $submissionId;
    public $grade;

    protected $rules = [
        'grade' => 'required|integer|min:0|max:100', ];

    public function mount($submissionId)
    {
        $submission = AssignmentSubmission::findOrFail($submissionId);
        $this->submissionId = $submission->id;
        $this->grade = $submission->grade;
    }

    public function saveGrade()
    {
        $this->validate();

        $submission = AssignmentSubmission::findOrFail($this->submissionId);
        $submission->update([
            'grade' => $this->grade,
        ]);

        session()->flash('message', 'Grade successfully updated.');
    }

    public function render()
    {
        $submission = AssignmentSubmission::with(['assignment', 'student'])
            ->findOrFail($this->submissionId);

        return view('livewire.instructor-submission-show', [
            'submission' => $submission,
        ]);
    }
}
