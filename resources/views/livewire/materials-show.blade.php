<div>
    <x-header :title="$material->title" size="text-xl" />

    <x-card class="mb-4">
        <div class="p-4">
            <h3 class="text-lg font-semibold">{{ $material->title }}</h3>

            @if($material->description)
                <p class="text-gray-600 mt-2">{{ $material->description }}</p>
            @endif

            @if($material->type)
                <p class="mt-2">
                    <strong>Type: </strong> {{ ucfirst($material->type) }}
                </p>
            @endif

            @if($material->url)
                <p class="mt-2">
                    <strong>Download: </strong>
                    <a href="{{ $material->url }}" target="_blank" class="text-blue-500">
                        {{ basename($material->url) }}
                    </a>
                </p>
            @endif

            <div class="mt-4 text-sm text-gray-500">
                Created on: {{ \Carbon\Carbon::parse($material->created_at)->format('M d, Y') }}
            </div>

            <div class="text-sm text-gray-500">
                Last updated: {{ \Carbon\Carbon::parse($material->updated_at)->format('M d, Y') }}
            </div>
        </div>
    </x-card>

    <!-- Edit Material Button -->
    <a href="{{ route('materials.edit', ['id' => $material->id]) }}" class="btn btn-secondary mt-4">
        Edit Material
    </a>
    
    <!-- Button to Delete Material -->
    <button wire:click.prevent="deleteMaterial" class="btn btn-danger mt-4" onclick="confirm('Are you sure you want to delete this material? This action cannot be undone.') || event.stopImmediatePropagation();" spinner>
        Delete Material
    </button>
</div>
