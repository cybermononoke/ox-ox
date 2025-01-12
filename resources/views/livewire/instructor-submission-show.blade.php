<div class="space-y-6">
    <x-card>
        <x-header title="Submission Details" size="text-xl" />
        <div class="space-y-4">
            <div>
                <h3 class="font-semibold">Assignment: {{ $submission->assignment->title }}</h3>
                <p class="text-gray-700">Submitted by: {{ $submission->student->name }}</p>
                <p class="text-gray-700">
                    File: <a href="{{ Storage::url($submission->file_path) }}" class="text-blue-500 underline" target="_blank">View Submission</a>
                </p>
                <p class="text-gray-700">Submitted at: {{ $submission->submitted_at }}</p>
            </div>
        </div>
    </x-card>

    <x-card>
        <x-header title="Grade Submission" size="text-xl" />

        <form wire:submit.prevent="saveGrade" class="space-y-4">
            <div>
                <label for="grade" class="block font-semibold">Grade (0-100):</label>
                <input type="number" id="grade" wire:model="grade" min="0" max="100" class="input" />
                @error('grade')
                <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <x-slot:actions>
                <x-button label="Save Grade" class="btn-primary" type="submit" spinner="saveGrade" />
            </x-slot:actions>
        </form>

        @if (session()->has('message'))
        <div class="mt-4 text-green-600">
            {{ session('message') }}
        </div>
        @endif
    </x-card>
</div>