<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class StudentPublicIndex extends Component
{

    public $students;
    public $sharedStudents = [];


    public function mount()
    {
        $this->getStudentList();
    }

    public function getStudentList()
    {
        $currentStudent = Auth::user()->student;
        $sharedBatches = $currentStudent->batches->pluck('id');
        $this->sharedStudents = Student::whereHas('batches', function ($query) use ($sharedBatches) {
            $query->whereIn('batches.id', $sharedBatches);
        })
            ->where('id', '!=', $currentStudent->id)
            ->with('user', 'batches')
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.student-public-index');
    }
}
