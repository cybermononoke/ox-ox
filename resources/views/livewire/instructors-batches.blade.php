<div>
    <div class="p-6 pb-20">  
        <div class="sm:flex sm:items-center sm:justify-between">
            <x-header title="Batches" size="text-xl" />
            <x-button>
                Create New Batch
            </x-button>
        </div>

        <div class="mt-4">
            <x-input wire:model.live="search" type="text" placeholder="Search batches..." />
        </div>

        <div class="overflow-auto">
            @foreach($batches as $batch)
            <x-list-item :item="$batch" :link="route('batches.show', $batch)">
                <x-slot:value>
                    {{ $batch->name }}
                </x-slot:value>

                <x-slot:sub-value>
                    Belongs to instructor {{ $batch->instructor->name }}<br />
                    Course: {{ $batch->course->title }}
                </x-slot:sub-value>
            </x-list-item>
            @endforeach
        </div>

    </div>
</div>