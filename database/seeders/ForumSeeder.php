<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Forum;
use App\Models\Course;

class ForumSeeder extends Seeder
{
    public function run()
    {
        if (Course::count() === 0) {
            $this->command->info('No courses found. Please create some courses first.');
            return;
        }

        $courses = Course::all();

        foreach ($courses as $course) {
            Forum::create([
                'title' => "Forum for {$course->title}",
                'description' => "Discussion forum for the course {$course->title}.",
                'course_id' => $course->id,
            ]);
        }
    }
}
