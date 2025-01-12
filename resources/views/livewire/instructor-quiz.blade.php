<div>
    @if($quizzes->isEmpty())
    <p>No quizzes available.</p>
    @else
    <x-button icon="o-document-plus" label="New Quiz" link="/quizzes/create" />

    @foreach ($quizzes as $quiz)
    <x-list-item :item="$quiz">
        <x-slot:avatar>
            <x-badge value="Quiz" class="badge-primary" />
        </x-slot:avatar>
        <x-slot:value>
            {{ $quiz->title }}
        </x-slot:value>
        <x-slot:sub-value>
            Due: {{ $quiz->due_date }} | Total points: {{ $quiz->total_points }}
        </x-slot:sub-value>
        <x-slot:actions>
            <x-button icon="o-pencil" link="{{ route('quizzes.edit', $quiz->id) }}" />
            <x-button icon="o-trash" wire:click.prevent="deleteQuiz({{ $quiz->id }})" onclick="confirm('Are you sure you want to delete this quiz? This action cannot be undone.') || event.stopImmediatePropagation();" spinner />

            <x-button
                icon="{{ $quiz->is_locked ? 'o-lock-closed' : 'o-lock-open' }}"
                wire:click="toggleLock({{ $quiz->id }})"
                label="{{ $quiz->is_locked ? 'Unlock' : 'Lock' }}" />


        </x-slot:actions>
    </x-list-item>
    @endforeach
    @endif
</div>