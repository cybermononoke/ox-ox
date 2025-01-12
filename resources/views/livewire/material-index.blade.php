<div>
    {{-- Material Creation --}}
    <x-button icon="o-document-plus" label="New Materials" link="{{ route('materials.create', ['courseId' => $courseId]) }}" />

    <div>
        @if ($materials->isEmpty())
        <p class="text-gray-500 text-center py-4">No materials available for this course.</p>
        @else
        @foreach ($materials as $material)
        <x-list-item :item="$material" link="{{ route('materials.show', ['materialId' => $material->id]) }}">
            <x-slot:avatar>
                <x-badge value="{{ ucfirst($material->type) }}" class="badge-info" />
            </x-slot:avatar>
            <x-slot:value>
                {{ $material->title }}
            </x-slot:value>
            <x-slot:sub-value>
                {{ $material->description }}
            </x-slot:sub-value>
            <x-slot:actions>
                <x-button icon="o-pencil" link="{{ route('materials.edit', ['id' => $material->id]) }}" />
                <x-button icon="o-trash" wire:click.prevent="deleteMaterial({{ $material->id }})" onclick="confirm('Are you sure you want to delete this material? This action cannot be undone.') || event.stopImmediatePropagation();" spinner />
            </x-slot:actions>
        </x-list-item>
        @endforeach
        @endif
    </div>
</div>
