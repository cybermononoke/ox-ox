<div>
    @if($student)
    <x-card title="{{ $student->user->name }}" subtitle="{{ $student->user->email }}" shadow separator>
        <x-slot:figure>
            <img src="https://picsum.photos/500/200" />
        </x-slot:figure>
        {{$student->bio}}
    </x-card>
    @else
    <p>Student not found.</p>
    @endif
</div>