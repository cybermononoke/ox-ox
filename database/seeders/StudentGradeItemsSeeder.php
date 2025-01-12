<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentGradeItemsSeeder extends Seeder
{
    public function run()
    {
        DB::table('student_grade_items')->insert([
            [
                'grade_item_id' => 1,
                'student_id' => 1,
                'points_earned' => 85.5,
                'feedback' => 'Solid performance, good understanding of the material',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'grade_item_id' => 1,
                'student_id' => 2,
                'points_earned' => 92.3,
                'feedback' => 'Outstanding work!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'grade_item_id' => 2,
                'student_id' => 1,
                'points_earned' => 180,
                'feedback' => 'Great work on the final project',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more entries as needed
        ]);
    }
}
