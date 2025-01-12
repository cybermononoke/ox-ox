<div>
    <div>
        <x-header title="{{ $selectedCourse->title ?? 'Course Details' }}" size="text-2xl" />

        <div class="flex justify-center mt-8">
            <div class="w-3/4 space-y-6">

                <x-tabs wire:model="selectedTab">

                    <!-- Modules Tab -->
                    <x-tab name="modules-tab" label="Modules" icon="o-rectangle-stack">
                        <x-card>
                            @foreach($modules as $module)
                            <x-list-item
                                :item="$module"
                                link="{{ route('assignment.index', ['moduleId' => $module->id]) }}">

                                <x-slot:value>
                                    {{ $module->title }}
                                </x-slot:value>
                                <x-slot:sub-value>
                                    {{ $module->description }}
                                </x-slot:sub-value>
                            </x-list-item>
                            @endforeach
                        </x-card>
                    </x-tab>

                    <x-tab name="forum-tab" label="Forum" icon="o-users">
                        <livewire:forum-index :selectedCourseId="$selectedCourseId" />
                    </x-tab>

                    <!-- People Tab -->
                    <x-tab name="people-tab" label="People" icon="o-users">
                        <livewire:student-public-index />
                    </x-tab>


                    <!-- Materials Tab -->
                    <x-tab name="materials-tab" label="Materials" icon="o-book-open">
                        <x-card>
                            <livewire:student-materials-index :courseId="$selectedCourseId" />
                        </x-card>
                    </x-tab>

                    <x-tab name="announcements-tab" label="Announcements" icon="o-academic-cap">
                        <livewire:announcement-index :course="$selectedCourseId" />
                    </x-tab>

                </x-tabs>
            </div>
        </div>
    </div>
</div>