<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Course;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.instructor')]
class QuizCreate extends Component
{
    public $title;
    public $due_date;
    public $total_points;
    public $course_id;
    public $questions = [];

    public function mount()
    {
        $this->questions = [
            ['text' => '', 'points' => 1, 'answers' => [['text' => '', 'is_correct' => false]]],
        ];
    }

    public function addQuestion()
    {
        $this->questions[] = ['text' => '', 'points' => 1, 'answers' => [['text' => '', 'is_correct' => false]]];
    }

    public function addAnswer($questionIndex)
    {
        $this->questions[$questionIndex]['answers'][] = ['text' => '', 'is_correct' => false];
    }

    public function save()
    {
        $quiz = Quiz::create([
            'title' => $this->title,
            'due_date' => $this->due_date,
            'total_points' => $this->total_points,
            'course_id' => $this->course_id, 
        ]);

        foreach ($this->questions as $q) {
            $question = $quiz->questions()->create([
                'question_text' => $q['text'],
                'points' => $q['points'],
            ]);

            foreach ($q['answers'] as $a) {
                $question->answers()->create([
                    'answer_text' => $a['text'],
                    'is_correct' => $a['is_correct'],
                ]);
            }
        }

        session()->flash('message', 'Quiz created successfully!');
        return redirect()->route('instructor.quizzes.index');
    }

    public function render()
    {
        $courses = Course::all()->map(function($course) {
            $course->name = $course->title; // Dynamically add the 'name' property
            return $course;
        });
        return view('livewire.quiz-create', compact('courses'));
    }
}
