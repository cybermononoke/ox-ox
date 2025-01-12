<div class="chat-container pb-20" wire:poll>
    <x-header title="{{ $chatroomName }}" size="text-xl" />

    <div class="messages-container">
        @foreach($messages as $message)
        <div class="message {{ isset($message['user_id']) && $message['user_id'] == Auth::id() ? 'sent' : 'received' }}">
            <div class="message-header">
                <x-list-item :item="$message" no-separator no-hover>
                    <x-slot:avatar>
                        <img src="{{ asset($message['user']['avatar']) }}" alt="Avatar" class="avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;" />
                    </x-slot:avatar>

                    <x-slot:value>
                        {{ isset($message['user']['name']) ? $message['user']['name'] : 'Unknown User' }},
                        {{ isset($message['created_at']) ? \Carbon\Carbon::parse($message['created_at'])->diffForHumans() : '' }}
                    </x-slot:value>
                    <x-slot:sub-value>
                        {{ $message['content'] ?? 'No message content' }}
                    </x-slot:sub-value>
                    <x-slot:actions>
                    </x-slot:actions>
                </x-list-item>
            </div>
        </div>
        @endforeach
    </div>

    <form wire:submit.prevent="sendMessage" class="message-input-form">
        <x-textarea
            wire:model="newMessage"
            placeholder="Type your message..."
            class="message-input"></x-textarea>
        <x-button type="submit" class="btn-primary">Send</x-button>
    </form>
</div>