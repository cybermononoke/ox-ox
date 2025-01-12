<div>
    <x-header title="Quizzes" size="text-xl" />

    @if($quizzes->isEmpty())
        <x-card>
            <div class="p-4 text-center text-gray-500">
                No quizzes available.
            </div>
        </x-card>
    @else
        @foreach ($quizzes as $quiz)
            <x-list-item :item="$quiz">
                <x-slot:avatar>
                    <x-badge value="Quiz" class="badge-primary" />
                </x-slot:avatar>

                <x-slot:value>
                    {{ $quiz->title }}
                </x-slot:value>

                <x-slot:sub-value>
                    Due: {{ $quiz->due_date }}
                </x-slot:sub-value>

                <x-slot:actions>
                    @if($quiz->is_locked)
                        <span class="text-red-500 font-bold">(Locked)</span>
                    @else
                        <x-button label="Take Quiz" link="/quiz/{{ $quiz->id }}/show" />
                    @endif
                </x-slot:actions>
            </x-list-item>
        @endforeach
    @endif
</div>
