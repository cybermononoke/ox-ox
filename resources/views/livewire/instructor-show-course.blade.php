<div>
    <div>
        <x-header title="{{ $selectedCourse->title ?? 'Course Details' }}" size="text-2xl" />

        <div class="flex justify-center mt-8">

            <x-tabs wire:model="selectedTab">

                <x-tab name="module-tab" label="Modules">
                    <livewire:instructor-module-index :courseId="$selectedCourseId" />
                </x-tab>

                <x-tab name="people-tab" label="People" icon="o-users">
                    <livewire:course-people-index :courseId="$selectedCourseId" />
                </x-tab>

                <x-tab name="materials-tab" label="Materials" icon="o-book-open">
                    <x-card>
                        <livewire:material-index :courseId="$selectedCourseId" />
                    </x-card>
                </x-tab>

                <x-tab name="announcements-tab" label="Announcements" icon="o-megaphone">
                    <x-card>
                        <livewire:instructor-announcement-index :course-id="$selectedCourseId" />
                    </x-card>
                </x-tab>

            </x-tabs>


        </div>
    </div>
</div>