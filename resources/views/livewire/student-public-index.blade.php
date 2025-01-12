<div>
    @if(!empty($sharedStudents))
    @foreach($sharedStudents as $student)
    <x-list-item :item="$student['user']" link="{{ route('student.profile', ['studentId' => $student['id']]) }}" />
    @endforeach
    @else
    <div>No students found</div>
    @endif
</div>