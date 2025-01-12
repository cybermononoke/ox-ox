<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Models\Batch;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        (new BatchSeeder())->run();

        DB::table('batch_student')->truncate();

        $students = [
            [
                'name' => 'Student One',
                'email' => 'student1@example.com',
                'bio' => 'This is Student bio',
                'batch_ids' => [1],
                'avatar' => '/images/515-536x354.jpg',

            ],
            [
                'name' => 'Student Two',
                'email' => 'student2@example.com',
                'bio' => 'This is Student bio',
                'batch_ids' => [1, 2],
                'avatar' => '/images/515-536x354.jpg',

            ],
        ];

        foreach ($students as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => bcrypt('password123'),
                    'role' => 'student',
                ]
            );

            $student = Student::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'bio' => $data['bio'],
                    'avatar' => $data['avatar'], 
                ]
            );
            if ($student->exists) {
                $existingBatchIds = Batch::whereIn('id', $data['batch_ids'])->pluck('id')->toArray();
                if (!empty($existingBatchIds)) {
                    $student->batches()->sync($existingBatchIds);
                }
            }
        }
    }
}
