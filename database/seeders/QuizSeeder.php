<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Module;
use Illuminate\Support\Carbon;

class QuizSeeder extends Seeder
{
    public function run()
    {

        $module = Module::first();

        $quiz = Quiz::create([
            'module_id' => $module->id,
            'title' => 'Sample Quiz',
            'due_date' => Carbon::now()->addDays(7),
        ]);

        $questions = [
            [
                'question_text' => 'What is the capital of France?',
                'answers' => [
                    ['answer_text' => 'Paris', 'is_correct' => true],
                    ['answer_text' => 'London', 'is_correct' => false],
                    ['answer_text' => 'Rome', 'is_correct' => false],
                ],
            ],
            [
                'question_text' => 'Which planet is known as the Red Planet?',
                'answers' => [
                    ['answer_text' => 'Mars', 'is_correct' => true],
                    ['answer_text' => 'Venus', 'is_correct' => false],
                    ['answer_text' => 'Jupiter', 'is_correct' => false],
                ],
            ],
            [
                'question_text' => 'Who wrote &quot;Hamlet&quot;?',
                'answers' => [
                    ['answer_text' => 'William Shakespeare', 'is_correct' => true],
                    ['answer_text' => 'Charles Dickens', 'is_correct' => false],
                    ['answer_text' => 'Jane Austen', 'is_correct' => false],
                ],
            ],
        ];

        foreach ($questions as $q) {
            $question = $quiz->questions()->create([
                'question_text' => $q['question_text'],
            ]);

            foreach ($q['answers'] as $a) {
                $question->answers()->create($a);
            }
        }
    }
}
