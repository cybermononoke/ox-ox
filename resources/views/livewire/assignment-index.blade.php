<div>
    <div class="pb-20">
        <x-header title="Assignments" size="text-xl" />
        @if(count($assignments) > 0)
        @foreach($assignments as $assignment)
        <x-list-item
            :item="$assignment"
            link="{{ $assignment['is_locked'] ? '#' : route('assignment.show', $assignment['id']) }}"
            class="{{ $assignment['is_locked'] ? 'cursor-not-allowed' : 'cursor-pointer' }}">

            <x-slot:avatar>
                {{-- Optional avatar if needed --}}
            </x-slot:avatar>

            <x-slot:value>
                {{ $assignment['title'] }}
            </x-slot:value>

            <x-slot:sub-value>
                Due: {{ \Carbon\Carbon::parse($assignment['due_date'])->format('M d, Y') }}
                @if(isset($assignment['max_points']))
                <span class="ml-2">Points: {{ $assignment['max_points'] }}</span>
                @endif

                @if($assignment['is_locked'])
                <span class="ml-4 text-red-500 font-bold">(Locked)</span>
                @endif
            </x-slot:sub-value>

            <x-slot:actions>
                {{-- Actions can be added here if required --}}
            </x-slot:actions>
        </x-list-item>
        @endforeach
        @else
        <x-card>
            <div class="p-4 text-center text-gray-500">
                No assignments found for this module.
            </div>
        </x-card>
        @endif
        <livewire:quiz-index />
    </div>
</div>