<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;
use App\Models\Module;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

class InstructorModuleIndex extends Component
{
    public bool $drawer = false;
    public ?int $courseId = null;
    
    #[Computed]
    public function modules()
    {
        if (!$this->courseId) {
            return collect();
        }

        return Module::where('course_id', $this->courseId)
            ->orderBy('order', 'asc')
            ->get();
    }

    public function updateOrder($items)
    {
        foreach ($items as $item) {
            Module::where('id', $item['value'])
                ->where('course_id', $this->courseId)
                ->update(['order' => $item['order']]);
        }

        $this->dispatch('modules-reordered');
    }

    public function deleteModule($moduleId)
    {
        $module = Module::where('id', $moduleId)
            ->where('course_id', $this->courseId)
            ->first();

        if ($module) {
            $module->delete();
            $this->dispatch('module-deleted');
            session()->flash('success', 'Module deleted successfully.');
        }
    }

    public function render()
    {
        return view('livewire.instructor-module-index', [
            'modules' => $this->modules()
        ]);
    }
}