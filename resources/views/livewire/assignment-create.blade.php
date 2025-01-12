<div>
    <x-header title="Create Assignment" size="text-xl" />

    <div>
        @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif

        <form wire:submit.prevent="submit" class="space-y-4">


            <div class="mb-4">
                <x-input
                    label="Title"
                    wire:model="title"
                    placeholder="Assignment title"
                    hint="Enter a descriptive title for the assignment" />
                @error('title') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <x-input
                    label="Description"
                    type="textarea"
                    wire:model="description"
                    placeholder="Brief description of the assignment"
                    hint="Describe what the assignment is about" />
                @error('description') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <x-input
                    label="Due Date"
                    type="date"
                    wire:model="due_date"
                    hint="Set a due date for the assignment" />
                @error('due_date') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <x-input
                    label="Max Points"
                    type="number"
                    wire:model="max_points"
                    placeholder="Maximum points for this assignment"
                    hint="Enter the maximum points that can be awarded" />
                @error('max_points') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-primary w-full">
                Create Assignment
            </button>
        </form>
    </div>