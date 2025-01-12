<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Course;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $courses = Course::all();

        foreach ($courses as $course) {
            for ($i = 1; $i <= 5; $i++) {
                Module::create([
                    'course_id' => $course->id,
                    'title' => "Module $i for {$course->title}",
                    'description' => "Detailed overview of Module $i in {$course->title}.",
                ]);
            }
        }
    }
}
