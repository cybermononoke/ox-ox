<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Forum;
use App\Models\ForumPost;
use App\Models\User;

class ForumPostSeeder extends Seeder
{
    public function run()
    {
        if (User::count() === 0) {
            User::factory(5)->create();
        }

        if (Forum::count() === 0) {
            $this->command->info('No forums found. Please run the ForumSeeder first.');
            return;
        }

        $users = User::all();
        $forums = Forum::all();

        foreach ($forums as $forum) {
            for ($i = 1; $i <= 10; $i++) {
                $post = ForumPost::create([
                    'forum_id' => $forum->id,
                    'title' => "Post in {$forum->title} #$i",
                    'content' => "This is a sample post in the {$forum->title} forum.",
                    'user_id' => $users->random()->id,
                    'parent_id' => null,
                ]);

                for ($j = 1; $j <= 3; $j++) {
                    ForumPost::create([
                        'forum_id' => $forum->id,
                        'title' => "Reply to {$post->title}",
                        'content' => "This is a reply #$j to post #$i in the {$forum->title} forum.",
                        'user_id' => $users->random()->id,
                        'parent_id' => $post->id,
                    ]);
                }
            }
        }
    }
}
