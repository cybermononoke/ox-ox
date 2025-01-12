<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ForumPost;
use App\Models\Forum;
use Illuminate\Support\Facades\Auth;

class ForumShow extends Component
{
    public $forumId;
    public $forum;
    public $posts;
    public $newPostContent = '';
    public $replyContent = [];
    public $showReplyForm = null;


    protected $rules = [
        'newPostContent' => 'required|min:3|max:5000',
    ];

    public function mount($forumId)
    {
        $this->forumId = $forumId;
        $this->forum = Forum::findOrFail($forumId);
        $this->loadPosts();
    }

    public function loadPosts()
    {
        $this->posts = ForumPost::where('forum_id', $this->forumId)
            ->whereNull('parent_id')
            ->with('replies.user', 'user.student')
            ->latest()
            ->get();
    }

    public function createPost()
    {
        $this->validate([
            'newPostContent' => 'required|min:3|max:5000'
        ]);

        if (!Auth::check()) {
            session()->flash('error', 'You must be logged in to create a post.');
            return;
        }

        ForumPost::create([
            'title' => 'Post from ' . Auth::user()->name, // You might want to modify this
            'content' => $this->newPostContent,
            'user_id' => Auth::id(),
            'forum_id' => $this->forumId,
            'parent_id' => null,
        ]);

        $this->reset('newPostContent');
        $this->loadPosts();

        session()->flash('success', 'Your post has been created successfully.');
    }

    public function addReply($parentPostId)
    {
        $this->validate([
            "replyContent.{$parentPostId}" => 'required|min:3|max:5000'
        ]);

        if (!Auth::check()) {
            session()->flash('error', 'You must be logged in to reply.');
            return;
        }

        ForumPost::create([
            'title' => 'Reply to post', // You might want to modify this
            'content' => $this->replyContent[$parentPostId],
            'user_id' => Auth::id(),
            'forum_id' => $this->forumId,
            'parent_id' => $parentPostId,
        ]);

        unset($this->replyContent[$parentPostId]);
        $this->showReplyForm = null; 
        $this->loadPosts(); 
        session()->flash('success', 'Your reply has been posted successfully.');
    }

    public function toggleReplyForm($postId)
    {
        $this->showReplyForm = $this->showReplyForm === $postId ? null : $postId;
    }


    public function render()
    {
        return view('livewire.forum-show', [
            'forum' => $this->forum,
            'posts' => $this->posts,
            'showReplyForm' => $this->showReplyForm,
        ]);
    }
}
