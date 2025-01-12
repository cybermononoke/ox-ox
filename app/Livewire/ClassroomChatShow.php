<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Chatroom;
use App\Models\Message;

class ClassroomChatShow extends Component
{
    public $chatroomId;
    public $chatroomName; // Store the chatroom name
    public $messages = [];
    public $newMessage = '';

    public function mount($chatroomId = null)
    {
        if ($chatroomId === null) {
            $chatroomId = request()->route('selectedCourseId')
                ?? request()->input('selectedCourseId')
                ?? null;
        }

        if (!$chatroomId) {
            abort(404, 'Chatroom not specified');
        }

        $user = Auth::user();
        $chatroom = Chatroom::findOrFail($chatroomId);
        if (!$user->student->chatrooms->contains($chatroomId)) {
            abort(403, 'Unauthorized access to this chatroom');
        }

        $this->chatroomId = $chatroomId;
        $this->chatroomName = $chatroom->name; // Store the name of the chatroom
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $messages = Message::where('course_id', $this->chatroomId)
            ->with(['user.student', 'user.instructor'])
            ->orderBy('created_at', 'asc')
            ->get();

        $this->messages = $messages->map(function ($message) {
            return [
                'id' => $message->id,
                'content' => $message->content,
                'user_id' => $message->user_id,
                'created_at' => $message->created_at,
                'user' => [
                    'name' => $message->user->name ?? 'Unknown User',
                    'avatar' => $message->user->instructor->avatar ??
                        $message->user->student->avatar ??
                        'default-avatar.png'
                ]
            ];
        })->toArray();
    }

    public function sendMessage()
    {
        $this->validate([
            'newMessage' => 'required|string|max:1000'
        ]);

        Message::create([
            'content' => $this->newMessage,
            'course_id' => $this->chatroomId,
            'user_id' => Auth::id()
        ]);

        $this->newMessage = '';
        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.classroom-chat-show', [
            'messages' => $this->messages,
            'chatroomName' => $this->chatroomName // Pass the chatroom name
        ]);
    }
}
