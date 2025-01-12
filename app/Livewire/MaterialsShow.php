<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CourseMaterial;

class MaterialsShow extends Component
{
    public $material;

    public function mount($materialId)
    {
        $this->material = CourseMaterial::findOrFail($materialId);
    }

    public function render()
    {
        return view('livewire.materials-show');
    }
}
