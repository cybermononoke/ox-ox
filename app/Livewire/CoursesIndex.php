<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class CoursesIndex extends Component
{
    public bool $drawer = false;
    public Collection $courses;
    public array $courseGrades = []; 

    public function mount()
    {
        $student = Auth::user()->student;
        $this->courses = $student->courses;
        $this->getGrades($student);
    }

    public function getGrades($student)
    {
        foreach ($this->courses as $course) {
            $grade = $course->students()
                ->where('student_id', $student->id)
                ->first()
                ->pivot
                ->grade; 
            $this->courseGrades[$course->id] = $grade; 
        }
    }

    public function navigateToCourse($id)
    {
        $this->redirect("/course/{$id}");
    }

    public function render()
    {
        return view('livewire.courses-index');
    }
}
