<div class="container mx-auto p-6">
        @if ($materials->isEmpty())
            <p class="text-gray-500 text-center py-4">No materials available for this course.</p>
        @else
            @foreach ($materials as $material)
                <x-list-item :item="$material" link="{{ route('student.materials.show', ['materialId' => $material->id]) }}">
                    <x-slot:avatar>
                        <x-badge value="{{ ucfirst($material->type) }}" class="badge-info" />
                    </x-slot:avatar>
                    <x-slot:value>
                        {{ $material->title }}
                    </x-slot:value>
                    <x-slot:sub-value>
                        {{ $material->description }}
                    </x-slot:sub-value>
                </x-list-item>
            @endforeach
        @endif
</div>
