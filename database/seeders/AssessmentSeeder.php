<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Assessment;
use App\Models\Course;
use Carbon\Carbon;

class AssessmentSeeder extends Seeder
{
    public function run(): void
    {
        $courses = Course::all();

        foreach ($courses as $course) {
            Assessment::create([
                'course_id' => $course->id,
                'type' => 'Midterm Exam',
                'weight' => 0.3,
                'date' => Carbon::now()->addWeeks(6),
            ]);

            Assessment::create([
                'course_id' => $course->id,
                'type' => 'Final Exam',
                'weight' => 0.5,
                'date' => Carbon::now()->addWeeks(12),
            ]);
        }
    }
}
