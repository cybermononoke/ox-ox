<div>
    <x-header title="Chatrooms" size="text-xl" />
    <div class="flex justify-center pb-20">
        <div class="w-full max-w-5xl">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @if($chatrooms->isNotEmpty())
                @foreach($chatrooms as $chatroom)
                <x-card title="{{$chatroom->name}}">
                    <button wire:click="goToChatroom({{ $chatroom->id }})" class="btn btn-primary">Enter</button>
                    <button wire:click="leaveChatroom({{ $chatroom->id }})" class="btn btn-danger" onclick="confirm('Are you sure you want to leave this chatroom? This action cannot be undone.') || event.stopImmediatePropagation();" spinner>Leave</button>
                </x-card>
                @endforeach
                @else
                <p>No chatrooms available. You may not be enrolled in any courses yet.</p>
                @endif
            </div>

            <div class="flex justify-center mt-6">
                <x-button icon="o-document-plus" label="New Chatroom" link="/chatroom/new" />
            </div>
        </div>
    </div>
</div>