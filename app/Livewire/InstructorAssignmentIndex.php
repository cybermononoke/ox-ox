<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Module;
use App\Models\Assignment;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.instructor')]
class InstructorAssignmentIndex extends Component
{
    public $module;
    public $assignments = [];
    public $editingAssignment = null;

    public function mount($moduleId)
    {
        $this->module = Module::findOrFail($moduleId);
        $this->loadAssignments();
    }

    public function loadAssignments()
    {
        $query = Assignment::where('module_id', $this->module->id);
        $this->assignments = $query->get()->toArray();
    }

    public function deleteAssignment($assignmentId)
    {
        $assignment = Assignment::findOrFail($assignmentId);
        $assignment->delete();
        $this->loadAssignments();
    }

    public function editAssignment($assignmentId)
    {
        $this->editingAssignment = Assignment::findOrFail($assignmentId)->toArray();
    }

    public function saveAssignment()
    {
        $assignment = Assignment::find($this->editingAssignment['id']);
        $assignment->update($this->editingAssignment);
        $this->editingAssignment = null;
        $this->loadAssignments();
    }

    public function toggleLock($assignmentId)
    {
        $assignment = Assignment::findOrFail($assignmentId);
        $assignment->is_locked = !$assignment->is_locked;
        $assignment->save();

        $this->loadAssignments();
        session()->flash('message', 'Assignment ' . ($assignment->is_locked ? 'locked' : 'unlocked') . ' successfully!');
    }

    public function render()
    {
        return view('livewire.instructor-assignment-index');
    }
}
