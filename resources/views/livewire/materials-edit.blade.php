<div>
    <x-header title="Edit Material" size="text-xl" />

    <x-form wire:submit.prevent="updateMaterial">
        <x-input
            label="Title"
            wire:model.defer="title"
            error-class="text-red-500" />

        <x-textarea
            label="Description"
            wire:model.defer="description"
            error-class="text-red-500" />

        <x-select
            label="Type"
            wire:model.defer="type"
            :options="[['value' => 'document', 'label' => 'Document'], ['value' => 'video', 'label' => 'Video'], ['value' => 'other', 'label' => 'Other']]"
            option-value="value"
            option-label="label" />

        <x-slot:actions>
            <x-button label="Cancel" link="{{ route('materials.index', ['courseId' => $courseId]) }}" />
            <x-button label="Update" class="btn-primary" type="submit" spinner="updateMaterial" />
        </x-slot:actions>
    </x-form>

    @if (session()->has('success'))
    <div class="mt-4 text-green-600">
        {{ session('success') }}
    </div>
    @endif
</div>
