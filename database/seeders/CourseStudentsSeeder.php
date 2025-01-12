<?php

namespace Database\Seeders;

use App\Models\CourseStudent;
use Illuminate\Database\Seeder;

class CourseStudentsSeeder extends Seeder
{
    public function run()
    {
        CourseStudent::firstOrCreate(
            ['course_id' => 1, 'student_id' => 1],
            ['grade' => 85.5, 'letter_grade' => 'B', 'comments' => 'Good progress throughout the semester']
        );

        CourseStudent::firstOrCreate(
            ['course_id' => 1, 'student_id' => 2],
            ['grade' => 92.3, 'letter_grade' => 'A', 'comments' => 'Excellent work and consistency']
        );
    }
}
