<div>
    <div class="pb-20">
        <x-header title="Assignments" size="text-xl" />

        <x-button icon="o-document-plus" label="New Assignment" link="{{ route('assignments.create', $module->id) }}" />

        @if(count($assignments) > 0)
        @foreach($assignments as $assignment)
        <x-list-item :item="$assignment" link="{{ route('instructor.assignment.show', $assignment['id']) }}" class="cursor-pointer">
            <x-slot:avatar>

            </x-slot:avatar>
            <x-slot:value>
                {{ $assignment['title'] }}
            </x-slot:value>
            <x-slot:sub-value>
                Due: {{ \Carbon\Carbon::parse($assignment['due_date'])->format('M d, Y') }}
                @if(isset($assignment['max_points']))
                <span class="ml-2">Points: {{ $assignment['max_points'] }}</span>
                @endif
            </x-slot:sub-value>
            <x-slot:actions>
                <x-button icon="o-pencil" wire:click="editAssignment({{ $assignment['id'] }})" />
                <x-button icon="o-trash" wire:click.prevent="deleteAssignment({{ $assignment['id'] }})" onclick="confirm('Are you sure you want to delete this assignment? This action cannot be undone.') || event.stopImmediatePropagation();" spinner />

                <x-button
                    icon="{{ $assignment['is_locked'] ? 'o-lock-closed' : 'o-lock-open' }}"
                    wire:click="toggleLock({{ $assignment['id'] }})"
                    label="{{ $assignment['is_locked'] ? 'Unlock' : 'Lock' }}" />


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

        <x-header title="Quizzes" size="text-xl" />
        <livewire:instructor-quiz />
    </div>
</div>