<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Quiz;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.instructor')]
class InstructorQuiz extends Component
{
    public $selectedCourseId;

    public function deleteQuiz($quizId)
    {
        $quiz = Quiz::find($quizId);

        if ($quiz) {
            $quiz->delete();

            session()->flash('message', 'Quiz deleted successfully!');
        } else {
            session()->flash('error', 'Quiz not found!');
        }
    }

    public function toggleLock($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $quiz->is_locked = !$quiz->is_locked;
        $quiz->save();

        session()->flash('message', 'Quiz ' . ($quiz->is_locked ? 'locked' : 'unlocked') . ' successfully!');
    }

    public function render()
    {
        if ($this->selectedCourseId) {
            $quizzes = Quiz::with('questions.answers')
                ->where('course_id', $this->selectedCourseId)
                ->get();
        } else {
            $quizzes = Quiz::with('questions.answers')->get();
        }

        return view('livewire.instructor-quiz', compact('quizzes'));
    }
}
