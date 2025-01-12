<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssignmentSubmission;
use App\Models\Assignment;
use App\Models\Student;
use Illuminate\Support\Str;

class AssignmentSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 10) as $index) {
            $assignment = Assignment::inRandomOrder()->first(); 
            $student = Student::inRandomOrder()->first(); 

            AssignmentSubmission::create([
                'assignment_id' => $assignment->id,
                'student_id' => $student->id,
                'file_path' => 'uploads/submissions/' . Str::random(10) . '.pdf', 
                'submitted_at' => now()->subDays(rand(0, 10)),
                'grade' => rand(50, 100), 
            ]);
        }
    }
}
