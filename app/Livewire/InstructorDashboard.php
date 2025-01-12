<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

#[Layout('components.layouts.instructor')]
#[Title('Instructor Dashboard')]
class InstructorDashboard extends Component
{
    public bool $drawer = false;
    public Collection $courses;

    public function mount()
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $instructor = $user->instructor;

        if (!$instructor) {
            session()->flash('error', 'You do not have instructor privileges.');
            return redirect()->route('home');
        }

        $this->courses = $instructor->courses()->with(['students'])->get();
    }

    public function navigateToCourse($courseId)
    {
        return redirect()->route('instructor.course.show', ['id' => $courseId]);
    }


    public function render()
    {
        return view('livewire.instructor-dashboard');
    }
}
