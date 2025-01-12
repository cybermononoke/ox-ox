<div>
    <form wire:submit.prevent="submit" class="shadow-md rounded-lg p-6 space-y-6">
        <div class="mb-4">
            {{-- File Upload --}}
            <x-input
                type="file"
                wire:model="file"
                accept=".pdf,.docx,.txt"
                label="Assignment File"
                hint="Only PDF, DOCX, and TXT files are allowed" 
                required />
            @error('file')
            <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
            @enderror

            @if ($file)
            <p class="text-sm text-green-600 mt-2">
                File uploaded: {{ $file->getClientOriginalName() }}
            </p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary w-full">
            Submit Assignment
        </button>

        @if (session()->has('message'))
        <div class="text-green-600 mt-4">
            {{ session('message') }}
        </div>
        @endif
    </form>
</div>
