<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CourseMaterial;
use App\Models\Course;

class CourseMaterialsSeeder extends Seeder
{
    public function run(): void
    {
        $courses = Course::all();

        foreach ($courses as $course) {
            CourseMaterial::create([
                'course_id' => $course->id,
                'type' => 'Book',
                'title' => "Textbook for {$course->name}",
                'url' => 'http://example.com/textbook',
                'description' => "The primary textbook for {$course->name}.",
            ]);

            CourseMaterial::create([
                'course_id' => $course->id,
                'type' => 'Video Lecture',
                'title' => "Lecture Series for {$course->name}",
                'url' => 'http://example.com/lecture',
                'description' => "Lecture series covering {$course->name}.",
            ]);
        }
    }
}
