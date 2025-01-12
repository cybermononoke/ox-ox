<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Announcement;
use App\Models\Course;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.instructor')]
class AnnouncementEdit extends Component
{
    public $announcementId;
    public $title;
    public $content;
    public $course_id;
    public $courses;

    public function mount($id)
    {
        $this->announcementId = $id;
        $announcement = Announcement::findOrFail($id);
        
        $this->title = $announcement->title;
        $this->content = $announcement->content;
        $this->course_id = $announcement->course_id;
        $this->courses = Course::all();
    }

    public function updateAnnouncement()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'course_id' => 'required|exists:courses,id',
        ]);

        $announcement = Announcement::findOrFail($this->announcementId);
        $announcement->update([
            'title' => $this->title,
            'content' => $this->content,
            'course_id' => $this->course_id,
        ]);

        session()->flash('success', 'Announcement updated successfully.');
        
        // Redirect back to the index with the course_id parameter
        return redirect()->route('announcements.index', ['courseId' => $this->course_id]);
    }

    public function render()
    {
        return view('livewire.announcement-edit');
    }
}