<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Batch;
use App\Models\Instructor;
use App\Models\Course;

class BatchSeeder extends Seeder
{
    public function run()
    {
        $instructors = Instructor::all();
        $courses = Course::all();

        if ($instructors->isEmpty()) {
            $instructor1 = Instructor::create([
                'name' => 'Instructor 1',
                'email' => 'instructor1@example.com',
                'password' => bcrypt('password'),
            ]);

            $instructor2 = Instructor::create([
                'name' => 'Instructor 2',
                'email' => 'instructor2@example.com',
                'password' => bcrypt('password'),
            ]);
            
            $instructors = collect([$instructor1, $instructor2]);
        }

        if ($courses->isEmpty()) {
            $course1 = Course::create([
                'title' => 'Course 1',
                'description' => 'Description for Course 1',
                'instructor_id' => $instructors->random()->id,
                'credits' => 3,
                'duration' => '3 months',
            ]);

            $course2 = Course::create([
                'title' => 'Course 2',
                'description' => 'Description for Course 2',
                'instructor_id' => $instructors->random()->id,
                'credits' => 4,
                'duration' => '4 months',
            ]);

            $courses = collect([$course1, $course2]);
        }

        foreach (range(1, 10) as $index) {
            Batch::create([
                'name' => "Batch {$index}",
                'instructor_id' => $instructors->random()->id,
                'course_id' => $courses->random()->id, 
            ]);
        }
    }
}
