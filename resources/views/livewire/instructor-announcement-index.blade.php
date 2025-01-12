<div>
    @if($announcements->isEmpty())
    <p>No announcements available.</p>
    @else
    <x-button
        label="New Announcement"
        icon="o-document-plus"
        link="{{ route('announcements.create', ['courseId' => $courseId]) }}" />

    @foreach($announcements as $announcement)
    <x-list-item :item="$announcement">
        <x-slot:avatar>
            <x-badge value="{{ $announcement->course->title}}" class="badge-primary" />
        </x-slot:avatar>
        <x-slot:value>
            {{ $announcement->title }}
        </x-slot:value>
        <x-slot:sub-value>
            {{ $announcement->content }}
        </x-slot:sub-value>

        <x-slot:actions>
            <x-button icon="o-pencil" link="{{ route('announcements.edit', ['id' => $announcement->id]) }}" />
            <x-button icon="o-trash" wire:click.prevent="delete({{ $announcement->id }})"  onclick="confirm('Are you sure you want to delete this announcement? This action cannot be undone.') || event.stopImmediatePropagation();" spinner />
        </x-slot:actions>
    </x-list-item>
    @endforeach
    @endif
</div>