<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;
use App\Models\Module;
use Livewire\Attributes\Layout;


#[Layout('components.layouts.instructor')]

class InstructorShowCourse extends Component
{

    public bool $drawer = false;
    public $selectedCourse;
    public $modules = [];

    public function mount($id)
    {
        $this->selectedCourse = Course::find($id);
        $this->getModules();
    }

    public function getModules()
    {
        $modules = $this->modules = Module::where('course_id', $this->selectedCourse->id)
            ->orderBy('order', 'asc')
            ->get();

        return $modules;
    }

    public function render()
    {
        return view(
            'livewire.instructor-show-course',
            [
                'selectedCourseId' => $this->selectedCourse->id
            ]
        );
    }
}

