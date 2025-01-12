<div>
    <x-header title="Courses" size="text-xl" />
    <div class="flex justify-center pb-20">
        <div class="w-full max-w-5xl">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($this->courses as $course)
                <div wire:key="course-{{ $course->id }}" wire:click="navigateToCourse({{ $course->id }})" class="cursor-pointer hover:scale-105 transition-transform duration-200">
                    <x-card title="{{ $course->title }}" subtitle="Course Details">
                        <x-slot:menu>
                            <x-slot:figure>
                                <img src="{{ asset('images/360-536x354.jpg') }}" alt="Course image" />
                            </x-slot:figure>
                            <x-button class="btn-circle" tooltip="Credits">
                                {{ $course->credits }}
                            </x-button>
                            <x-button class="btn-circle" tooltip="Grade">
                                {{ $this->courseGrades[$course->id] ?? 'No grade' }}
                            </x-button>
                        </x-slot:menu>
                    </x-card>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>