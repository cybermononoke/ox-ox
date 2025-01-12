<div>
    @if(!empty($students))
    @foreach($students as $student)
    <x-list-item :item="$student" link="{{ route('student.profile', ['studentId' => $student['id']]) }}" class="cursor-pointer">
        <x-slot:value>
            {{ $student['user']['name'] ?? 'N/A' }}
        </x-slot:value>
        <x-slot:sub-value>
            Custom sub-value
        </x-slot:sub-value>
    </x-list-item>

    @endforeach
    @else
    <div>No students found</div>
    @endif
</div>