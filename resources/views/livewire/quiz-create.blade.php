<div>
    <x-header title="Create Quiz" size="text-xl" />

    <div>
        @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif

        <form wire:submit.prevent="save" class="space-y-4">
            <!-- Quiz Title -->
            <div class="mb-4">
                <x-input
                    label="Quiz Title"
                    wire:model="title"
                    placeholder="Enter quiz title"
                    hint="Provide a title for your quiz"
                    required />
                @error('title') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Due Date and Total Points -->
            <div>
                <x-datetime label="Due Date" wire:model="due_date" id="due_date" icon="o-calendar" />
            </div>

            <div>
                <x-input label="Total Points" wire:model="total_points" type="number" min="1" placeholder="Enter points" required />
            </div>
            <div>
                <x-select
                    label="Course"
                    icon="o-user"
                    :options="$courses"
                    wire:model="course_id" />
            </div>


            <!-- Questions -->
            @foreach ($questions as $index => $question)
            <div class="p-4 border rounded-md mb-4 space-y-4">
                <x-input
                    label="Question {{ $index + 1 }}"
                    wire:model="questions.{{ $index }}.text"
                    placeholder="Enter question text"
                    required />
                @error("questions.{{ $index }}.text")
                <span class="text-red-600">{{ $message }}</span>
                @enderror

                <!-- Points for Question -->
                <x-input
                    label="Points for Question {{ $index + 1 }}"
                    wire:model="questions.{{ $index }}.points"
                    type="number"
                    min="1"
                    placeholder="Enter points"
                    required />
                @error("questions.{{ $index }}.points")
                <span class="text-red-600">{{ $message }}</span>
                @enderror

                <!-- Answers -->
                <div class="space-y-4">
                    @foreach ($question['answers'] as $answerIndex => $answer)
                    <div class="flex items-center space-x-4">
                        <x-input
                            label="Answer {{ $answerIndex + 1 }}"
                            wire:model="questions.{{ $index }}.answers.{{ $answerIndex }}.text"
                            placeholder="Enter answer text"
                            required />
                        <x-checkbox
                            label="Correct"
                            wire:model="questions.{{ $index }}.answers.{{ $answerIndex }}.is_correct" />
                    </div>
                    @error("questions.{{ $index }}.answers.{{ $answerIndex }}.text")
                    <span class="text-red-600">{{ $message }}</span>
                    @enderror
                    @endforeach
                    <button
                        type="button"
                        wire:click="addAnswer({{ $index }})"
                        class="btn btn-secondary w-full">
                        Add Answer
                    </button>
                </div>
            </div>
            @endforeach


            <!-- Add Question -->
            <button
                type="button"
                wire:click="addQuestion"
                class="btn btn-secondary w-full">
                Add Question
            </button>

            <!-- Save Quiz -->
            <button type="submit" class="btn btn-primary w-full">
                Save Quiz
            </button>
        </form>
    </div>
</div>