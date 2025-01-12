<div>
    <div class="p-6">
        <div class="mb-6">
            <x-header :title="$batch->name" size="text-2xl" />
            <div>
                Instructor: {{ $batch->instructor->name }}
            </div>
        </div>

        @forelse($batch->students as $student)

        <x-list-item :item="$student">
            <x-slot:value>
                {{ $student->user->name }}
            </x-slot:value>
            <x-slot:sub-value>
                {{ $student->user->email }}
            </x-slot:sub-value>

        </x-list-item>

        @empty
        No students enrolled in this batch yet.
        @endforelse
    </div>
</div>