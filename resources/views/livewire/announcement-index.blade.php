<div>
    @if($announcements->isEmpty())
        <p>No announcements available.</p>
    @else
        @foreach($announcements as $announcement)
            <x-list-item :item="$announcement" wire:click="showAnnouncement({{ $announcement->id }})" class="cursor-pointer">
                <x-slot:avatar>
                    <x-badge value="new" class="badge-primary" />
                </x-slot:avatar>
                <x-slot:value>
                    {{ $announcement->title }}
                </x-slot:value>
                <x-slot:sub-value>
                    {{ $announcement->content }}
                </x-slot:sub-value>
            </x-list-item>
        @endforeach
    @endif
</div>
