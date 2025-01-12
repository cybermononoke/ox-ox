<?php

namespace App\Livewire;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class SubmitAssignment extends Component
{
    use WithFileUploads;

    public $assignment;
    public $file;
    public $grade;

    public function mount($assignmentId)
    {
        // Fetch the assignment by ID
        $this->assignment = Assignment::findOrFail($assignmentId);
    }

    public function submit()
    {
        $this->validate([
            'file' => 'required|file|mimes:pdf,docx,txt',
        ]);

        $filePath = $this->file->store('assignments', 'public');

        AssignmentSubmission::create([
            'assignment_id' => $this->assignment->id,
            'student_id' => Auth::user()->student->id,
            'file_path' => $filePath,
            'submitted_at' => now(),
        ]);

        // Update the assignment's submission status
        $this->assignment->update(['submitted' => true]);

        // Check if the assignment is overdue
        if ($this->assignment->due_date < now()) {
            $this->assignment->update(['overdue' => true]);
        }

        session()->flash('message', 'Assignment submitted successfully!');
    }

    public function render()
    {
        return view('livewire.submit-assignment');
    }
}
