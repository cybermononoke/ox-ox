<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\StudentGradeItem;
use Illuminate\Support\Facades\Auth;

class CourseGrades extends Component
{
    public $courseId;
    public $assignmentGrades = [];

    public function mount($course)
    {
        $this->courseId = $course;
        $studentId = Auth::id();

        $this->assignmentGrades = StudentGradeItem::where('student_id', $studentId)
            ->whereHas('gradeItem', function ($query) {
                $query->where('course_id', $this->courseId);
            })
            ->with(['gradeItem'])
            ->get();
    }

    public function render()
    {
        return view('livewire.course-grades', [
            'assignmentGrades' => $this->assignmentGrades,
        ]);
    }
}
