<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class AnnouncementIndex extends Component
{
    public $announcements;
    public $course;



    public function mount($course)
    {
        $this->course = Course::findOrFail($course);
        $this->announcements = $this->course->announcements()->latest()->get();
    }

    public function showAnnouncement($announcementId)
    {
        return redirect()->to(route('announcement.show', ['id' => $announcementId]));
    }

    public function render()
    {
        return view('livewire.announcement-index', [
            'announcements' => $this->announcements,
        ]);
    }
}
