<?php

namespace App\Livewire;

use App\Models\Assignment;
use App\Models\Module;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.instructor')]
class AssignmentCreate extends Component
{
    public $module;
    public $module_id;
    public $title;
    public $description;
    public $due_date;
    public $max_points;

    public function mount(Module $module)
    {
        $this->module = $module;
        $this->module_id = $module->id;
    }

    protected $rules = [
        'module_id' => 'required|exists:modules,id',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'due_date' => 'required|date',
        'max_points' => 'required|integer|min:1',
    ];

    public function submit()
    {
        $this->validate();

        $assignment = Assignment::create([
            'module_id' => $this->module_id,
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->due_date,
            'max_points' => $this->max_points,
        ]);

        return $this->redirect(route('instructor.assignment.index', ['moduleId' => $this->module_id]));
    }

    public function render()
    {
        return view('livewire.assignment-create', [
            'module' => $this->module
        ]);
    }
}