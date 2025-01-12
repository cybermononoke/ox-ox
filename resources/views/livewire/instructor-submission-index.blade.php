<div>
    <div class="pb-20">
        <x-header title="Submission Index" size="text-xl" />
        @if($submissions->isEmpty())
        <p class="text-gray-500">No submissions available.</p>
        @else
        @foreach($submissions as $submission)
        <x-list-item :item="$submission" class="cursor-pointer" link="{{ route('submissions.show', $submission->id) }}">
            <x-slot:avatar>
                <x-badge value="Submitted" class="badge-success" />
            </x-slot:avatar>

            <x-slot:value>
                {{ $submission->student->name }}
            </x-slot:value>

            <x-slot:sub-value>
                Assignment: {{ $submission->assignment->title }} <br>
                Submitted at: {{ $submission->submitted_at ?? 'Not Submitted' }} <br>
                Grade: {{ $submission->grade ?? 'Not Graded' }}
            </x-slot:sub-value>
        </x-list-item>
        @endforeach
        @endif
    </div>
</div>