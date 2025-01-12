<div>
    <x-header title="Grade Assignment" size="text-xl" />

    <!-- Show grade item details -->
    <x-card>
        <h3 class="text-lg font-semibold">{{ $studentGradeItem->gradeItem->title }}</h3>
        <p><strong>Due Date:</strong> {{ $studentGradeItem->gradeItem->due_date->format('M d, Y') }}</p>
        <p><strong>Description:</strong> {{ $studentGradeItem->gradeItem->description }}</p>

        <!-- Grade input form -->
        <form wire:submit.prevent="saveGrade">
            <div class="mt-4">
                <label for="grade" class="block text-sm font-medium text-gray-700">Grade</label>
                <input type="number" id="grade" wire:model="grade" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" max="{{ $studentGradeItem->gradeItem->max_points }}" min="0">
                @error('grade') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <label for="feedback" class="block text-sm font-medium text-gray-700">Feedback</label>
                <textarea id="feedback" wire:model="feedback" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" rows="4"></textarea>
                @error('feedback') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4 flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    Save Grade
                </button>
            </div>
        </form>
    </x-card>

    <!-- Success message -->
    @if (session()->has('message'))
        <div class="mt-4 text-green-600">
            {{ session('message') }}
        </div>
    @endif
</div>
