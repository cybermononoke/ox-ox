<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;

class StudentPublicProfile extends Component
{
    public $studentId;
    public $student;

    public function mount($studentId)
    {
        $this->studentId = $studentId;
        $this->getStudentDetails();
    }

    public function getStudentDetails()
    {
        $this->student = Student::with('user', 'batches')
            ->findOrFail($this->studentId);
    }

    public function render()
    {
        return view('livewire.student-public-profile');
    }
}
