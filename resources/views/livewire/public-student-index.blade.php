<div>
    <x-header title="Students" size="text-xl" />

    @if(!empty($sharedStudents))
    @foreach($sharedStudents as $student)
    <x-list-item :item="$student">
        <x-slot:value>
            {{ $student['user']['name'] ?? 'N/A' }}
        </x-slot:value>
    </x-list-item>
    @endforeach
    @else
    <div>No students found</div>
    @endif
</div>