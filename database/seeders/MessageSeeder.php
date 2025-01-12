<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\User;
use App\Models\Course;
use Faker\Factory as Faker;

class MessageSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $courses = Course::all();
        foreach ($courses as $course) {
            for ($i = 0; $i < 10; $i++) {
                $user = User::inRandomOrder()->first();
                Message::create([
                    'content' => $faker->sentence(10),
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                ]);
            }
        }
    }
}
