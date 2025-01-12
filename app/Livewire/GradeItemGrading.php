<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GradeItem;
use App\Models\StudentGradeItem;
use Illuminate\Support\Facades\Auth;

class GradeItemGrading extends Component
{
    public $courseId;
    public $gradeItemId;
    public $studentGradeItem;
    public $grade;
    public $feedback;

    // Initialize the component with courseId and gradeItemId
    public function mount($courseId, $gradeItemId)
    {
        $this->courseId = $courseId;
        $this->gradeItemId = $gradeItemId;

        // Fetch the student grade item for the given grade item and course
        $this->studentGradeItem = StudentGradeItem::where('grade_item_id', $this->gradeItemId)
            ->where('student_id', Auth::id())  // Only the authenticated instructor
            ->first();

        if ($this->studentGradeItem) {
            $this->grade = $this->studentGradeItem->points_earned;
            $this->feedback = $this->studentGradeItem->feedback;
        }
    }

    // Save the grade and feedback
    public function saveGrade()
    {
        // Validate the grade input
        $this->validate([
            'grade' => 'required|numeric|min:0|max:' . $this->studentGradeItem->gradeItem->max_points,
            'feedback' => 'nullable|string|max:500',
        ]);

        // Update the grade and feedback
        $this->studentGradeItem->update([
            'points_earned' => $this->grade,
            'feedback' => $this->feedback,
        ]);

        // Optionally, add a success message or redirect
        session()->flash('message', 'Grade and feedback saved successfully!');
    }

    public function render()
    {
        return view('livewire.grade-item-grading');
    }
}
