<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CourseMaterial;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.instructor')]
class MaterialIndex extends Component
{
    public $courseId;
    public $materials;

    public function mount($courseId)
    {
        $this->courseId = $courseId;
        $this->loadMaterials();
    }

    public function loadMaterials()
    {
        $this->materials = CourseMaterial::where('course_id', $this->courseId)->get();
    }

    public function deleteMaterial($id)
    {
        CourseMaterial::find($id)->delete();
        $this->loadMaterials();
    }

    public function render()
    {
        return view('livewire.material-index', [
            'materials' => $this->materials,
        ]);
    }
}
