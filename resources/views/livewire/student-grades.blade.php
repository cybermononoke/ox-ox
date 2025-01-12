<div>
    <x-header title="Your Grades" size="text-xl" />

    @if($courseGrades->isEmpty() && $assignmentGrades->isEmpty())
    <p>No grades available.</p>
    @else

    @php
    $courseHeaders = [
    ['key' => 'course.title', 'label' => 'Course'],
    ['key' => 'grade', 'label' => 'Final Grade'],
    ['key' => 'letter_grade', 'label' => 'Letter Grade'],

    ];
    @endphp
    <x-table :headers="$courseHeaders" :rows="$courseGrades->map(fn($g) => [
            'course' => ['title' => $g->course->title ?? 'Course Title Not Available'],
            'grade' => $g->grade,
            'letter_grade' => $g->letter_grade,

        ])" striped />
    @endif
</div>