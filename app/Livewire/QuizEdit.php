<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Quiz;
use Livewire\Attributes\Layout;


#[Layout('components.layouts.instructor')]
class QuizEdit extends Component
{
    public $quizId;
    public $title;
    public $due_date;
    public $total_points;
    public $questions = [];

    public function mount($quiz)
    {
        $quiz = Quiz::with('questions.answers')->findOrFail($quiz);
        $this->quizId = $quiz->id;
        $this->title = $quiz->title;
        $this->due_date = $quiz->due_date;
        $this->total_points = $quiz->total_points;
        $this->questions = $quiz->questions->map(function ($question) {
            return [
                'id' => $question->id,
                'text' => $question->text,
                'points' => $question->points,
                'answers' => $question->answers->map(function ($answer) {
                    return [
                        'id' => $answer->id,
                        'text' => $answer->text,
                        'is_correct' => $answer->is_correct,
                    ];
                })->toArray(),
            ];
        })->toArray();
    }

    public function save()
    {
        $quiz = Quiz::findOrFail($this->quizId);
        $quiz->update([
            'title' => $this->title,
            'due_date' => $this->due_date,
            'total_points' => $this->total_points,
        ]);

        foreach ($this->questions as $questionData) {
            if (isset($questionData['id'])) {
                $question = $quiz->questions()->findOrFail($questionData['id']);
                $question->update([
                    'text' => $questionData['text'],
                    'points' => $questionData['points'],
                ]);
            } else {
                $question = $quiz->questions()->create([
                    'text' => $questionData['text'],
                    'points' => $questionData['points'],
                ]);
            }

            foreach ($questionData['answers'] as $answerData) {
                if (isset($answerData['id'])) {
                    $answer = $question->answers()->findOrFail($answerData['id']);
                    $answer->update([
                        'text' => $answerData['text'],
                        'is_correct' => $answerData['is_correct'],
                    ]);
                } else {
                    $question->answers()->create([
                        'text' => $answerData['text'],
                        'is_correct' => $answerData['is_correct'],
                    ]);
                }
            }

            $existingAnswerIds = collect($questionData['answers'])->pluck('id')->filter();
            $question->answers()->whereNotIn('id', $existingAnswerIds)->delete();
        }

        $existingQuestionIds = collect($this->questions)->pluck('id')->filter();
        $quiz->questions()->whereNotIn('id', $existingQuestionIds)->delete();

        session()->flash('message', 'Quiz updated successfully!');
    }


    public function render()
    {
        return view('livewire.quiz-edit');
    }
}
