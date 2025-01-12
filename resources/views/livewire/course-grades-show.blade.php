<div>
    <x-header title="Grades" size="text-xl pb-20" />

    @if($selectedGradeItem)
    <x-card>
        <h4 class="text-xl font-semibold">{{ $selectedGradeItem->title }}</h4>
        <p><strong>Due Date:</strong> {{ $selectedGradeItem->due_date->format('M d, Y') }}</p>
        <p><strong>Description:</strong> {{ $selectedGradeItem->description }}</p>

        @if($selectedGradeItem->studentGradeItems->isNotEmpty())
        <p><strong>Grade: </strong>{{ $selectedGradeItem->studentGradeItems->first()->points_earned }} / {{ $selectedGradeItem->max_points }}</p>
        @else
        <p><strong>Grade: </strong>No grade assigned yet.</p>
        @endif

        @if($selectedGradeItem->studentGradeItems->isNotEmpty() && $selectedGradeItem->studentGradeItems->first()->feedback)
        <p><strong>Feedback:</strong> {{ $selectedGradeItem->studentGradeItems->first()->feedback }}</p>
        @endif
    </x-card>
    @else
    <p>Grade item not found.</p>
    @endif
</div>