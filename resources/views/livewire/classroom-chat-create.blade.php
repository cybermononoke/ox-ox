<div class="container mx-auto px-4 py-6">
    @if(session()->has('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <form wire:submit.prevent="createChatroom" class="max-w-lg mx-auto shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h2 class="text-2xl font-bold mb-6 text-center">Create a New Chatroom</h2>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">
                Select Course
            </label>

            <x-select
                :options="$courses"
                wire:model.live="selectedCourse"
                option-value="id"
                option-label="title"
                placeholder="Select a Course" />

            @error('selectedCourse')
            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">
                Chatroom Name
            </label>
            <x-input type="text" wire:model="chatroomName" placeholder="Chatroom Name" />
            @error('chatroomName')
            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">
                Select Students
            </label>
            <div>
                @if(!$selectedCourse)
                <p class="text-gray-500">Please select a course first.</p>
                @elseif($mutualStudents->isEmpty())
                <p class="text-gray-500">No students found in this course.</p>
                @else
                <div class="space-y-2">
                    @foreach($mutualStudents as $student)
                    <div class="flex items-center">
                        <x-checkbox
                            wire:model="selectedStudents"
                            :label="$student->user->name"
                            :value="$student->id" />
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            @error('selectedStudents')
            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <x-button
                type="submit"
                class="btn-secondary">
                Create Chatroom
            </x-button>
        </div>
    </form>
</div>