<form wire:submit.prevent="saveMaterial" class="shadow-md rounded-lg p-6 space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- Left Column --}}
        <div>
            {{-- Type Selection --}}
            <div class="mb-4">
                <x-select
                    label="Type"
                    wire:model="selectedType"
                    :options="$type"
                    option-value="value" {{-- Maps the `value` key to the selected value --}}
                    option-label="name" {{-- Maps the `name` key to the display text --}}
                    placeholder="Select Type"
                    required />
                @error('selectedType')
                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror

                @error('type')
                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror

            </div>


            {{-- Title Input --}}
            <div class="mb-4">
                <x-input
                    label="Title"
                    wire:model="title"
                    placeholder="Enter material title"
                    required />
                @error('title')
                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Right Column --}}
        <div>
            {{-- Description Input --}}
            <div class="mb-4">
                <x-textarea
                    label="Description"
                    wire:model="description"
                    placeholder="Enter material description" />
                @error('description')
                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- URL Input --}}
            <div class="mb-4">
                <x-input
                    label="URL (Optional)"
                    type="url"
                    wire:model="url"
                    placeholder="Enter material URL" />
                @error('url')
                <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    {{-- File Upload --}}
    <div class="mb-4">
        <x-input
            type="file"
            wire:model="file"
            accept="application/pdf"
            label="Upload File (PDF only)"
            hint="Only PDF files are allowed" />
        @error('file')
        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
        @enderror

        @if ($file)
        <p class="text-sm text-green-600 mt-2">
            File uploaded: {{ $file->getClientOriginalName() }}
        </p>
        @endif
    </div>

    {{-- Submit Button --}}
    <div class="mt-6">
        <button type="submit" class="btn btn-primary w-full">
            {{ $materialId ? 'Update Material' : 'Add Material' }}
        </button>
    </div>
</form>