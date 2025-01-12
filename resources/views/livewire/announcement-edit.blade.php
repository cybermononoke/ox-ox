<div>
    <x-header title="Edit Announcement" size="text-xl" />

    <x-form wire:submit="updateAnnouncement">
        <x-input
            label="Title"
            wire:model.defer="title"
            error-class="text-red-600" />

        <x-textarea
            label="Content"
            wire:model.defer="content"
            error-class="text-red-600" />

        <x-select
            label="Course"
            id="course_id"
            wire:model.defer="course_id"
            :options="$courses"
            option-value="id"
            option-label="title">
        </x-select>

        <x-slot:actions>
            <x-button label="Cancel" link="/instructors/announcements/index" />
            <x-button label="Update Announcement" class="btn-primary" type="submit" spinner="updateAnnouncement" />
        </x-slot:actions>
    </x-form>

    @if (session()->has('success'))
    <div class="mt-4 text-green-600">
        {{ session('success') }}
    </div>
    @endif
</div>
