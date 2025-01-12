<div>
    <x-card>
        <x-button
            icon="o-document-plus"
            label="New Module"
            link="{{ route('modules.create', ['courseId' => $courseId]) }}" />


        @foreach($modules as $module)
        <x-list-item
            :item="$module"
            link="{{ route('instructor.assignment.index', ['moduleId' => $module->id]) }}">

            <x-slot:value>
                {{ $module->title }}
            </x-slot:value>
            <x-slot:sub-value>
                {{ $module->description }}
            </x-slot:sub-value>
            <x-slot:actions>
                <x-button icon="o-pencil" link="{{ route('modules.edit', ['moduleId' => $module->id]) }}" />
                <x-button icon="o-trash" class="btn-danger" wire:click.prevent="deleteModule({{ $module->id }})" onclick="confirm('Are you sure you want to delete this module? This action cannot be undone.') || event.stopImmediatePropagation();" spinner="deleteModule" />

            </x-slot:actions>

        </x-list-item>
        @endforeach
    </x-card>
</div>