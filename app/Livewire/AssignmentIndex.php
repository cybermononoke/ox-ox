<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Assignment;
use App\Models\Module;

class AssignmentIndex extends Component
{
    
    public $module;
    public $assignments = [];

    public function mount($moduleId)
    {
        $this->module = Module::findOrFail($moduleId);
        $this->loadAssignments();
    }

    public function loadAssignments()
    {
        $query = Assignment::where('module_id', $this->module->id);
        $assignments = $query->get();
        $this->assignments = $assignments->toArray();
    }


    public function render()
    {
        return view('livewire.assignment-index');
    }
}
