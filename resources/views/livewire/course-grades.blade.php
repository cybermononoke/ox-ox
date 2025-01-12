<div>
    @if($assignmentGrades->isEmpty())
        <p>No grades available for this course.</p>
    @else
        <x-card>
            @foreach($assignmentGrades as $grade)
                <x-list-item :item="$grade" link="{{ route('grade-items.show', ['courseId' => $courseId, 'gradeItemId' => $grade->gradeItem->id]) }}">
                    <x-slot:value>
                        {{ $grade->gradeItem->title }}
                        Due: {{ $grade->gradeItem->due_date->format('M d, Y') }}
                    </x-slot:value>
                    <x-slot:sub-value>
                        {{ $grade->points_earned }} / {{ $grade->gradeItem->max_points }}
                    </x-slot:sub-value>
                </x-list-item>
            @endforeach
        </x-card>
    @endif
</div>
