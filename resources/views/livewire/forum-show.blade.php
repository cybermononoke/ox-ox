<div class="pb-20">
    @foreach($posts as $post)
    <div class="pb-10">
        <x-list-item :item="$post">
            <x-slot:avatar>
                @if ($post->user->instructor)
                <img src="{{ asset($post->user->instructor->avatar) }}" alt="Avatar" class="avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;" />
                @elseif ($post->user->student)
                <img src="{{ asset($post->user->student->avatar) }}" alt="Avatar" class="avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;" />
                @endif
            </x-slot:avatar>
            <x-slot:value>
                {{ $post->user->name }}
                <span class="text-gray-500 text-sm ml-2">{{ $post->created_at->format('M d, h:i A') }}</span>
            </x-slot:value>
            <x-slot:sub-value>
                {{ $post->content }}
            </x-slot:sub-value>
            <x-slot:actions>
                <x-button wire:click="toggleReplyForm({{ $post->id }})" class="btn-secondary">
                    {{ $showReplyForm === $post->id ? 'Cancel' : 'Reply' }}
                </x-button>
            </x-slot:actions>
        </x-list-item>

        <div class="mt-4 ml-6 border-l pl-4">
            @foreach($post->replies as $reply)
            <x-list-item :item="$reply">
                <x-slot:avatar>
                    @if ($reply->user->instructor)
                    <img src="{{ asset($reply->user->instructor->avatar) }}" alt="Avatar" class="avatar" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;" />
                    @elseif ($reply->user->student)
                    <img src="{{ asset($reply->user->student->avatar) }}" alt="Avatar" class="avatar" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;" />
                    @endif
                </x-slot:avatar>
                <x-slot:value>
                    {{ $reply->user->name }}
                    <span class="text-gray-500 text-sm ml-2">{{ $reply->created_at->format('M d, h:i A') }}</span>
                </x-slot:value>
                <x-slot:sub-value>
                    {{ $reply->content }}
                </x-slot:sub-value>
            </x-list-item>
            @endforeach

            @if ($showReplyForm === $post->id)
            <div class="mt-4">
                <x-textarea
                    label="Reply"
                    wire:model.defer="replyContent.{{ $post->id }}"
                    placeholder="Write your reply..."
                    rows="3"
                    onpaste="return false;" />
                <x-button class="btn-primary mt-2" wire:click="addReply({{ $post->id }})">
                    Submit Reply
                </x-button>
            </div>
            @endif
        </div>
    </div>
    @endforeach

    <div class="mb-6">
        <x-textarea label="New Post" wire:model.defer="newPostContent" placeholder="Write a new post..." hint="Max 5000 chars" rows="5" inline onpaste="return false;" />
        <x-button class="btn-primary mt-2" wire:click="createPost">Post</x-button>
    </div>

    @if ($posts->isEmpty())
    <p class="text-gray-500 mt-4">No posts yet. Be the first to start the discussion!</p>
    @endif
</div>