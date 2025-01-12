<?php

namespace App\Livewire;

use App\Models\Announcement;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.instructor')]
#[Title('Create Announcements')]
class AnnouncementCreate extends Component
{
    public $title;
    public $content;
    public $course_id;

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'course_id' => 'required|exists:courses,id',
    ];

    public function createAnnouncement()
    {
        $this->validate();

        Announcement::create([
            'title' => $this->title,
            'content' => $this->content,
            'course_id' => $this->course_id,
        ]);

        session()->flash('success', 'Announcement created successfully!');
        $this->reset(['title', 'content', 'course_id']);
    }

    public function render()
    {
        return view('livewire.announcement-create', [
            'courses' => \App\Models\Course::all(),
        ]);
    }
}
