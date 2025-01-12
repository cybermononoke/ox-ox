<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Announcement;

class AnnouncementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::all();

        foreach ($courses as $course) {
            Announcement::create([
                'course_id' => $course->id,
                'title' => 'Welcome to ' . $course->name,
                'content' => 'This is the first announcement for the course ' . $course->name . '. Stay tuned for more updates!',
            ]);

            Announcement::create([
                'course_id' => $course->id,
                'title' => 'Exam Schedule for ' . $course->name,
                'content' => 'Please check the schedule for the upcoming exams in ' . $course->name . '.',
            ]);

            Announcement::create([
                'course_id' => $course->id,
                'title' => 'Project Guidelines for ' . $course->name,
                'content' => 'Here are the guidelines for the project in ' . $course->name . '. Make sure to follow all requirements.',
            ]);
        }
    }
}
