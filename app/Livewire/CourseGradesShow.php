<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GradeItem;

class CourseGradesShow extends Component
{
    public $courseId;
    public $gradeItemId;
    public $selectedGradeItem = null;

    public function mount($courseId, $gradeItemId)
    {
        $this->courseId = $courseId;
        $this->gradeItemId = $gradeItemId;

        $this->selectedGradeItem = GradeItem::with('studentGradeItems')
            ->where('id', $this->gradeItemId)
            ->where('course_id', $this->courseId)
            ->first();
    }

    public function render()
    {
        return view('livewire.course-grades-show');
    }
}
