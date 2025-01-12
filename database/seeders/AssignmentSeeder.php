<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Assignment;
use App\Models\Module;
use Carbon\Carbon;

class AssignmentSeeder extends Seeder
{
    public function run(): void
    {
        $modules = Module::all();

        foreach ($modules as $module) {
            for ($i = 1; $i <= 3; $i++) {
                Assignment::create([
                    'module_id' => $module->id,
                    'title' => "Assignment $i for {$module->title}",
                    'description' => "Description for Assignment $i in module {$module->id}.",
                    'due_date' => Carbon::now()->addWeeks($i),
                    'max_points' => 100,
                ]);
            }
        }
    }
}
