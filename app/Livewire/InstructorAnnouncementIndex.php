<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Announcement;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('components.layouts.instructor')]
class InstructorAnnouncementIndex extends Component
{
    public ?int $courseId = null;
    #[Computed]
    public function announcements()
    {
        return Announcement::query()
            ->when($this->courseId, function ($query) {
                $query->where('course_id', $this->courseId);
            })
            ->latest()
            ->get();
    }

    public function delete($id)
    {
        $announcement = Announcement::find($id);

        if ($announcement) {
            if ($announcement->course_id === $this->courseId) {
                $announcement->delete();
                session()->flash('success', 'Announcement deleted successfully.');
            } else {
                session()->flash('error', 'Unauthorized action.');
            }
        } else {
            session()->flash('error', 'Announcement not found.');
        }
    }

    public function render()
    {
        return view('livewire.instructor-announcement-index', [
            'announcements' => $this->announcements(),
        ]);
    }
}
