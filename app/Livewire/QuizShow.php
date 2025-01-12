<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Quiz;
use Illuminate\Support\Facades\Log;

class QuizShow extends Component
{
    public $quiz;
    public $answers = [];
    public $score = null;
    public $questionResults = [];

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;

        foreach ($this->quiz->questions as $question) {
            Log::info('Question Text Raw: ' . $question->getRawOriginal('question_text'));
            Log::info('Question Text Accessed: ' . $question->question_text);
        }
    }

    public function submit()
    {
        $this->score = 0;
        $this->questionResults = [];

        foreach ($this->quiz->questions as $question) {
            $selectedAnswerId = $this->answers[$question->id] ?? null;

            $result = [
                'question_id' => $question->id,
                'question_text' => html_entity_decode($question->question_text),
                'selected_answer_id' => $selectedAnswerId,
                'is_correct' => false
            ];

            if ($selectedAnswerId) {
                $selectedAnswer = $question->answers->find($selectedAnswerId);

                if ($selectedAnswer && $selectedAnswer->is_correct) {
                    $this->score++;
                    $result['is_correct'] = true;
                }
            }


            $correctAnswer = $question->answers->first(function ($answer) {
                return $answer->is_correct;
            });
            $result['correct_answer_id'] = $correctAnswer ? $correctAnswer->id : null;
            $result['correct_answer_text'] = $correctAnswer ? $correctAnswer->answer_text : null;

            $this->questionResults[] = $result;
        }
    }

    public function retakeQuiz()
    {
        $this->reset(['answers', 'score', 'questionResults']);
    }

    public function render()
    {
        return view('livewire.quiz-show', [
            'quiz' => $this->quiz,
        ]);
    }
}
