<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Chatroom;

class ClassroomChatIndex extends Component
{
    public $chatrooms = [];

    public function mount()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $this->chatrooms = $user->student->chatrooms;
        }
    }

    public function goToChatroom($chatroomId)
    {
        return redirect()->route('students.chatroom.show', ['selectedCourseId' => $chatroomId]);
    }

    public function leaveChatroom($chatroomId)
    {
        $user = Auth::user();
        $user->student->chatrooms()->detach($chatroomId);
        $this->chatrooms = $user->student->chatrooms;
    }



    public function render()
    {
        return view('livewire.classroom-chat-index', [
            'chatrooms' => $this->chatrooms
        ]);
    }
}
