<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Batch;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.instructor')]

class InstructorsShowBatch extends Component
{

    public Batch $batch;

    public function with(): array
    {
        return [
            'batch' => $this->batch->load(['instructor', 'students.user']),
        ];
    }

    public function mount(Batch $batch)
    {
        $this->batch = $batch;
    }

    public function render()
    {
        return view('livewire.instructors-show-batch');
    }
}
