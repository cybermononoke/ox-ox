<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseStudent;
use App\Models\StudentGradeItem;

class StudentGrades extends Component
{

    public $courseGrades = [];
    public $assignmentGrades = [];

    public function mount()
    {
        $studentId = Auth::id();
        $this->courseGrades = CourseStudent::where('student_id', $studentId)
            ->with('course')
            ->get();
        $this->assignmentGrades = StudentGradeItem::where('student_id', $studentId)
            ->with(['gradeItem.course'])
            ->get();
    }



    public function render()
    {
        return view('livewire.student-grades');
    }
}
