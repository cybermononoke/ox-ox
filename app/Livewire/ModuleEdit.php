<?php

namespace App\Livewire;

use App\Models\Module;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.instructor')]
class ModuleEdit extends Component
{
    public $moduleId;
    public $title;
    public $description;
    public $courseId;

    public function mount($moduleId)
    {
        $module = Module::findOrFail($moduleId);

        $this->moduleId = $module->id;
        $this->title = $module->title;
        $this->description = $module->description;
        $this->courseId = $module->course_id;
    }

    public function updateModule()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $module = Module::findOrFail($this->moduleId);
        $module->update([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Module updated successfully.');
        return redirect()->to("/instructors/courses/{$this->courseId}");
    }

    public function render()
    {
        return view('livewire.module-edit');
    }
}
