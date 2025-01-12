<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Instructor;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $instructors = Instructor::all();

        $course1 = Course::create([
            'title' => 'Introduction to Computer Science',
            'description' => 'An introductory course on computer science fundamentals.',
            'instructor_id' => $instructors->random()->id,
            'credits' => 3,
            'duration' => '12 weeks',
        ]);

        $course2 = Course::create([
            'title' => 'Data Structures',
            'description' => 'A course on essential data structures in programming.',
            'instructor_id' => $instructors->random()->id,
            'credits' => 4,
            'duration' => '12 weeks',
        ]);

        $course2->prerequisite()->attach($course1->id);

        Course::create([
            'title' => 'Algorithms',
            'description' => 'Study of algorithms, their complexity, and optimization.',
            'instructor_id' => $instructors->random()->id,
            'credits' => 3,
            'duration' => '12 weeks',
        ]);

        Course::create([
            'title' => 'Operating Systems',
            'description' => 'Understanding the design and function of operating systems.',
            'instructor_id' => $instructors->random()->id,
            'credits' => 3,
            'duration' => '12 weeks',
        ]);
    }
}
