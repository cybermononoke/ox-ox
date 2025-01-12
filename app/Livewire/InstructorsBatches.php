<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Batch;
use App\Models\Instructor;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;


#[Layout('components.layouts.instructor')]

class InstructorsBatches extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $showCreateModal = false;
    public $newBatchName = '';
    public $selectedInstructor = '';

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function createBatch()
    {
        $this->validate([
            'newBatchName' => 'required|min:3|max:255',
            'selectedInstructor' => 'required|exists:instructors,id'
        ]);

        Batch::create([
            'name' => $this->newBatchName,
            'instructor_id' => $this->selectedInstructor
        ]);

        $this->reset(['showCreateModal', 'newBatchName', 'selectedInstructor']);
        session()->flash('message', 'Batch created successfully.');
    }

    public function deleteBatch($batchId)
    {
        $batch = Batch::find($batchId);
        if ($batch) {
            $batch->delete();
            session()->flash('message', 'Batch deleted successfully.');
        }
    }

    public function render()
    {
        $batches = Batch::query()
            ->with(['instructor', 'students', 'course']) 
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhereHas('instructor', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    
        $instructors = Instructor::all();
    
        return view('livewire.instructors-batches', compact('batches', 'instructors'));
    }
    
}
