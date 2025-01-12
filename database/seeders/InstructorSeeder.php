<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Instructor;

class InstructorSeeder extends Seeder
{
    public function run()
    {
        $user = User::firstOrCreate(
            ['email' => 'instructor1@example.com'],
            [
                'name' => 'Instructor One',
                'password' => bcrypt('password123'),
                'role' => 'instructor',
            ]
        );

    

        Instructor::firstOrCreate([
            'user_id' => $user->id,
            'name' => $user->name,
            'bio' => 'This is Instructor One\'s bio',
            'avatar' => '/images/887-536x354.jpg', 

        ]);
    }
}
