<?php

namespace App\Livewire;

use App\Models\Forum;
use Livewire\Component;

class ForumIndex extends Component
{
    public $selectedCourseId;
    public $forums;

    public function mount($selectedCourseId)
    {
        $this->selectedCourseId = $selectedCourseId;

        $this->forums = Forum::where('course_id', $this->selectedCourseId)
            ->withCount('posts')
            ->get();
    }

    public function render()
    {
        return view('livewire.forum-index', [
            'forums' => $this->forums,
        ]);
    }
}
