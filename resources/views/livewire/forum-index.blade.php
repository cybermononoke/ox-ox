<div>
    <div class="pb-20">
        @foreach ($forums as $forum)
        <x-list-item :item="$forum" link="{{ route('forum.show', $forum) }}" class="cursor-pointer">
            <x-slot:avatar>
            </x-slot:avatar>
            <x-slot:value>
                {{ $forum->title }}
            </x-slot:value>
            <x-slot:sub-value>
                {{ $forum->description }}
            </x-slot:sub-value>
        </x-list-item>
        @endforeach
    </div>
</div>