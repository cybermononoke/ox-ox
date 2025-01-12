<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Chatroom;
use App\Models\Course;

class ClassroomChatCreate extends Component
{
    public $courses;
    public $selectedCourse = null;
    public $mutualStudents = [];
    public $selectedStudents = [];
    public $chatroomName;

    public function mount()
    {
        $this->courses = Auth::user()->student->courses;
    }

    public function updatedSelectedCourse($courseId)
    {
        $course = Course::findOrFail($courseId);
        $this->mutualStudents = $course->students->unique('id');
        $this->selectedStudents = [];
    }

    public function createChatroom()
    {
        $validated = $this->validate([
            'selectedCourse' => 'required|exists:courses,id',
            'chatroomName' => 'required|string|max:255',
            'selectedStudents' => 'required|array|min:1',
            'selectedStudents.*' => 'exists:students,id',
        ]);

        $chatroom = Chatroom::create([
            'name' => $validated['chatroomName'],
            'created_by' => Auth::id(),
            'course_id' => $validated['selectedCourse'],
        ]);

        $chatroom->students()->attach($validated['selectedStudents']);

        $this->reset(['selectedCourse', 'selectedStudents', 'chatroomName']);
        session()->flash('success', 'Chatroom created successfully');

        return redirect()->route('students.chatroom.index');
    }

    public function render()
    {
        return view('livewire.classroom-chat-create');
    }
}
