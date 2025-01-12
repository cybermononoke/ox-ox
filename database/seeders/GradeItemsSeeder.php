<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeItemsSeeder extends Seeder
{
    public function run()
    {
        DB::table('grade_items')->insert([
            [
                'course_id' => 1,
                'name' => 'Midterm Exam',
                'description' => 'Covers first half of the semester',
                'max_points' => 100,
                'weight' => 50,
                'due_date' => '2024-11-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 1,
                'name' => 'Final Project',
                'description' => 'Capstone project for the course',
                'max_points' => 200,
                'weight' => 50,
                'due_date' => '2024-12-20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more entries as needed
        ]);
    }
}
