<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CourseMaterial;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.instructor')]
class MaterialsEdit extends Component
{
    public $materialId;
    public $title;
    public $description;
    public $type;
    public $courseId; // Add this property

    public function mount($id)
    {
        $this->materialId = $id;
        $material = CourseMaterial::findOrFail($id);

        $this->title = $material->title;
        $this->description = $material->description;
        $this->type = $material->type;
        $this->courseId = $material->course_id; // Assign course_id to the property
    }

    public function updateMaterial()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|in:document,video,other',
        ]);

        $material = CourseMaterial::findOrFail($this->materialId);
        $material->update([
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type,
        ]);

        session()->flash('success', 'Material updated successfully.');

        // Redirect back to the index with the course_id parameter
        return redirect()->route('materials.index', ['courseId' => $this->courseId]);
    }

    public function render()
    {
        return view('livewire.materials-edit');
    }
}
