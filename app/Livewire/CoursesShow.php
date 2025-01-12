<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;
use App\Models\Module;

class CoursesShow extends Component
{
    public bool $drawer = false;
    public $selectedCourse;
    public $modules = [];

    public function mount($id)
    {
        $this->selectedCourse = Course::find($id);

        if (!$this->selectedCourse) {
            abort(404, 'Course not found');
        }

        $this->getModules();
    }

    public function getModules()
    {
        $this->modules = Module::where('course_id', $this->selectedCourse->id)
            ->with(['assignments', 'quizzes'])
            ->orderBy('order', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.courses-show', [
            'selectedCourseId' => $this->selectedCourse->id,
        ]);
    }
}
