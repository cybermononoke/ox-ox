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
</div>