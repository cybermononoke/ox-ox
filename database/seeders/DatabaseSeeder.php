<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            InstructorSeeder::class,
            BatchSeeder::class,
            StudentSeeder::class,
            CourseSeeder::class,
            CourseStudentsSeeder::class,
            GradeItemsSeeder::class,
            StudentGradeItemsSeeder::class,
            ModuleSeeder::class,
            AssignmentSeeder::class,
            AssessmentSeeder::class,
            CourseMaterialsSeeder::class,
            ForumSeeder::class,
            ForumPostSeeder::class,
            AnnouncementsSeeder::class,
            QuizSeeder::class,
            AssignmentSubmissionSeeder::class,
            MessageSeeder::class,

        ]);
    }
}
