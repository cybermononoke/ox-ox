<div>
    <x-header :title="$assignment->title" size="text-xl" />

    <x-card class="mb-4">
        <div class="p-4">
            <h3 class="text-lg font-semibold">{{ $assignment->title }}</h3>

            @if($assignment->description)
            <p class="text-gray-600 mt-2">{{ $assignment->description }}</p>
            @endif

            <div class="mt-4 text-sm text-gray-500">
                Due: {{ \Carbon\Carbon::parse($assignment->due_date)->format('M d, Y') }}
            </div>

            @if($assignment->max_points)
            <div class="text-sm text-gray-500">
                Points: {{ $assignment->max_points }}
            </div>
            @endif
        </div>
    </x-card>


    <!-- Button to Submit Assignment -->
    <a href="{{ route('assignment.submit', ['assignmentId' => $assignment->id]) }}" class="btn btn-primary">
        Submit Assignment
    </a>

</div>