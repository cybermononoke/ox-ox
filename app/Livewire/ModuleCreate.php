<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Module;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.instructor')]
class ModuleCreate extends Component
{
    public $title;
    public $description;
    public $courseId;

    public function mount($courseId = null)
    {
        if (!$courseId) {
            abort(404, 'Course not found.');
        }
        $this->courseId = $courseId;
    }

    public function createModule()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Module::create([
            'title' => $this->title,
            'description' => $this->description,
            'course_id' => $this->courseId,
        ]);

        session()->flash('success', 'Module created successfully.');
        return redirect()->to("/instructors/courses/{$this->courseId}");
    }

    public function render()
    {
        $course = Course::find($this->courseId);

        if (!$course) {
            abort(404, 'Course not found.');
        }

        return view('livewire.module-create', [
            'courseTitle' => $course->title,
        ]);
    }
}
