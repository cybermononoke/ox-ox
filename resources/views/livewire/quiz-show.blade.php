<div class="quiz-container pb-20">
    <x-header title="{{ $quiz->title }}" size="text-xl" />

    @if ($score !== null)
    <div class="quiz-results space-y-4">
        <h2 class="text-2xl font-bold mb-4">Your score: {{ $score }} / {{ $quiz->questions->count() }}</h2>

        @foreach ($questionResults as $result)
        <x-card
            class="{{ $result['is_correct'] ? ' border-green-200' : ' border-red-200' }}"
            title="{{ $result['question_text'] }}">
            <div class="space-y-2">
                <p class="font-semibold">
                    @if ($result['is_correct'])
                    <span class="text-green-600">✓ Correct!</span>
                    @else
                    <span class="text-red-600">✗ Incorrect</span>
                    @endif
                </p>

                <div class="answer-details">
                    @if ($result['selected_answer_id'])
                    <p>
                        Your answer:
                        <span class="{{ $result['is_correct'] ? 'text-green-800' : 'text-red-800' }}">
                            {{ $quiz->questions->find($result['question_id'])->answers->find($result['selected_answer_id'])->answer_text }}
                        </span>
                    </p>
                    @else
                    <p class="text-yellow-600">No answer selected</p>
                    @endif

                    <p class="text-green-800 font-semibold">
                        Correct answer: {{ $result['correct_answer_text'] }}
                    </p>
                </div>
            </div>
        </x-card>
        @endforeach

        <div class="mt-4">
            <x-button wire:click="retakeQuiz" class="w-full">
                Retake Quiz
            </x-button>
        </div>
    </div>
    @else
    <form wire:submit.prevent="submit" class="space-y-4">
        @foreach ($quiz->questions as $question)
        <x-card title="{!! $question->question_text !!}">
            <div class="space-y-2">
                @foreach ($question->answers as $answer)
                <label class="block">
                    <input
                        type="radio"
                        wire:model="answers.{{ $question->id }}"
                        value="{{ $answer->id }}"
                        class="mr-2">
                    {{ $answer->answer_text }}
                </label>
                @endforeach
            </div>
        </x-card>
        @endforeach

        <x-button type="submit" class="w-full">Submit Quiz</x-button>
    </form>
    @endif
</div>