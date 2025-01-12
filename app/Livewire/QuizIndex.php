<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Quiz;

class QuizIndex extends Component
{
    public $quizId; 

    public function takeQuiz($quizId)
    {
        $this->quizId = $quizId;
        return redirect()->route('quizzes.show', ['quiz' => $quizId]);
    }

    public function render()
    {
        if ($this->quizId) {
            $quiz = Quiz::with('questions.answers')->find($this->quizId);
            return view('livewire.quiz', compact('quiz'));
        }

        $quizzes = Quiz::with('questions.answers')->get();
        return view('livewire.quiz-index', compact('quizzes'));
    }
}
