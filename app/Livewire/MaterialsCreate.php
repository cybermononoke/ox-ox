<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\CourseMaterial;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.instructor')]
class MaterialsCreate extends Component
{
    use WithFileUploads;

    public $courseId;
    public $materialId = null;
    public $selectedType;
    public $title;
    public $description;
    public $url;
    public $file;
    public $type = [];

    protected $rules = [
        'selectedType' => 'required|in:pdf,video,textbook,other',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'url' => 'nullable|url',
        'file' => 'nullable|file|mimes:pdf|max:10240',
    ];

    protected $listeners = ['editMaterial'];

    public function mount()
    {
        $this->type = [
            ['value' => 'pdf', 'name' => 'PDF'],
            ['value' => 'video', 'name' => 'Video'],
            ['value' => 'textbook', 'name' => 'Textbook'],
            ['value' => 'other', 'name' => 'Other'],
        ];
    }

    public function saveMaterial()
    {
        $validatedData = $this->validate();

        if ($this->file) {
            $validatedData['url'] = $this->file->store('materials', 'public');
        }

        if ($this->materialId) {
            CourseMaterial::find($this->materialId)->update(array_merge($validatedData, ['type' => $this->selectedType]));
        } else {
            CourseMaterial::create(array_merge($validatedData, ['type' => $this->selectedType, 'course_id' => $this->courseId]));
        }

        $this->reset(['selectedType', 'title', 'description', 'url', 'file', 'materialId']);

        $this->dispatch('refreshMaterials');

        return redirect()->route('instructor.dashboard');
    }

    public function editMaterial($id)
    {
        $material = CourseMaterial::findOrFail($id);
        $this->materialId = $material->id;
        $this->selectedType = $material->type;
        $this->title = $material->title;
        $this->description = $material->description;
        $this->url = $material->url;
    }

    public function render()
    {
        return view('livewire.materials-create');
    }
}
