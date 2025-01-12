<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Announcement;
use App\Models\Assignment;

class AnnouncementShow extends Component
{
    public $announcement;
    public $assignment;

    public function mount($id, Assignment $assignment)
    {
        $this->announcement = Announcement::findOrFail($id);
        $this->assignment = $assignment;
    }

    public function render()
    {
        return view('livewire.announcement-show', [
            'assignment' => $this->assignment,
        ]);
    }
}
