<div>
    <x-header title="Edit Module" size="text-xl" />

    <x-form wire:submit="updateModule">
        <x-input
            label="Title"
            wire:model.defer="title"
            error-class="text-red-600" />

        <x-textarea
            label="Description"
            wire:model.defer="description"
            error-class="text-red-600" />

        <x-slot:actions>
            <x-button label="Cancel" link="/instructors/courses/{{ $courseId }}" />
            <x-button label="Update Module" class="btn-primary" type="submit" spinner="updateModule" />
        </x-slot:actions>
    </x-form>

    @if (session()->has('success'))
    <div class="mt-4 text-green-600">
        {{ session('success') }}
    </div>
    @endif
</div>
