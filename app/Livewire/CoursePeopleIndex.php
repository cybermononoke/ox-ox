<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;
use App\Models\User;

class CoursePeopleIndex extends Component
{
    public $selectedCourse;
    public $students = [];

    public function mount($courseId)
    {
        $this->selectedCourse = Course::find($courseId);
        $this->getStudents();
    }

    public function getStudents()
    {
        $this->students = $this->selectedCourse->students; 
    }

    public function render()
    {
        return view('livewire.course-people-index', [
            'students' => $this->students,
        ]);
    }
}
