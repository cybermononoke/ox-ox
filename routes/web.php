<?php

use App\Livewire\AnnouncementCreate;
use App\Livewire\AnnouncementIndex;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\Register;
use App\Livewire\PublicStudentIndex;
use App\Livewire\StudentGrades;
use App\Livewire\AssignmentIndex;
use App\Livewire\AssignmentShow;
use App\Livewire\TasksIndex;
use App\Livewire\ForumIndex;
use App\Livewire\ForumShow;
use App\Livewire\CoursesShow;
use App\Livewire\CoursesIndex;
use App\Livewire\InstructorsBatches;
use App\Livewire\InstructorsShowBatch;
use App\Livewire\StudentPublicProfile;
use App\Livewire\StudentPublicIndex;
use App\Livewire\AssignmentCreate;
use App\Livewire\InstructorDashboard;
use App\Livewire\InstructorShowCourse;
use App\Livewire\QuizCreate;
use App\Livewire\QuizIndex;
use App\Livewire\QuizShow;
use App\Livewire\QuizEdit;
use App\Livewire\InstructorQuiz;
use App\Livewire\CourseGradesShow;
use App\Livewire\GradeItemGrading;
use App\Livewire\InstructorAnnouncementIndex;
use App\Livewire\AnnouncementEdit;
use App\Livewire\AnnouncementShow;
use App\Livewire\Calendar;
use App\Livewire\ModuleCreate;
use App\Livewire\ModuleEdit;
use App\Livewire\MaterialIndex;
use App\Livewire\MaterialsCreate;
use App\Livewire\SubmitAssignment;
use App\Livewire\InstructorAssignmentIndex;
use App\Livewire\InstructorAssignmentShow;
use App\Livewire\InstructorSubmissionIndex;
use App\Livewire\InstructorSubmissionShow;
use App\Livewire\MaterialsEdit;
use App\Livewire\MaterialsShow;
use App\Livewire\StudentMaterialsShow;
use App\Livewire\Profile;
use App\Livewire\ClassroomChatIndex;
use App\Livewire\ClassroomChatShow;
use App\Livewire\ClassroomChatCreate;


Route::get('/', Home::class);
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class);
Route::get('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');


Route::get('/calendar', Calendar::class);

Route::get('/profile', Profile::class);


Route::get('/chatroom/new', ClassroomChatCreate::class);


// THEN PUT THESE BEHIND A STUDENT MIDDLEWARE

Route::middleware('auth')->group(function () {

    // students
    Route::get('/tasks', TasksIndex::class);

    Route::get('/grades', StudentGrades::class);

    Route::get('/publicstuff', PublicStudentIndex::class);

    Route::get('/forum', ForumIndex::class)->name('forum.index');
    Route::get('/forum/{forumId}/show', ForumShow::class)->name('forum.show');

    Route::get('/courses', CoursesIndex::class)->name('courses.index');
    Route::get('/course/{id}', CoursesShow::class)->name('courses.show');

    Route::get('/assignment-index/{moduleId}', AssignmentIndex::class)->name('assignment.index');
    Route::get('/assignment-show/{assignmentId}', AssignmentShow::class)->name('assignment.show');
    Route::get('/assignment-submit/{assignmentId}', SubmitAssignment::class)->name('assignment.submit');

    Route::get('/students/index', StudentPublicIndex::class);
    Route::get('/students/profile/{studentId}', StudentPublicProfile::class)->name('student.profile');

    Route::get('/course/{course}/announcements', AnnouncementIndex::class)->name('course.announcements');

    Route::get('/quizzes', QuizIndex::class)->name('quizzes.index');
    Route::get('/quiz/{quiz}/show', QuizShow::class)->name('quizzes.show');

    Route::get('/courses/{courseId}/grade-items/{gradeItemId}', CourseGradesShow::class)->name('grade-items.show');

    Route::get('/announcements/{id}', AnnouncementShow::class)->name('announcement.show');

    Route::get('/students/materials/{materialId}', StudentMaterialsShow::class)->name('student.materials.show');

    Route::get('/students/chatroom/index', ClassroomChatIndex::class)->name('students.chatroom.index');
    // Route::get('/students/chatroom', ClassroomChatShow::class)->name('students.chatroom.show');
    Route::get('/chatroom/{selectedCourseId}', ClassroomChatShow::class)->name('students.chatroom.show');
});





// routes/web.php

Route::middleware(['auth', 'instructor'])->group(function () {
    Route::get('/instructors/dashboard', InstructorDashboard::class)->name('instructor.dashboard');
    Route::get('/instructors/batches', InstructorsBatches::class)->name('batches.index');
    Route::get('/instructors/batches/{batch}', InstructorsShowBatch::class)->name('batches.show');

    Route::get('/assignments/create/{module}', AssignmentCreate::class)->name('assignments.create');
    Route::get('/instructor/assignment-index/{moduleId}', InstructorAssignmentIndex::class)->name('instructor.assignment.index');
    Route::get('/instructor/assignment-show/{assignmentId}', InstructorAssignmentShow::class)->name('instructor.assignment.show');

    Route::get('/instructors/submissions', InstructorSubmissionIndex::class)->name('instructor.submissions.index');
    Route::get('/submissions/{submissionId}', InstructorSubmissionShow::class)->name('submissions.show');

    Route::get('/instructors/courses/{id}', InstructorShowCourse::class)->name('instructor.course.show');

    Route::get('/instructors/quizzes', InstructorQuiz::class)->name('instructor.quizzes.index');
    Route::get('/quizzes/create', QuizCreate::class)->name('quizzes.create');
    Route::get('/quizzes/{quiz}', QuizShow::class)->name('quizzes.show');
    Route::get('/quizzes/{quiz}/edit', QuizEdit::class)->name('quizzes.edit');

    Route::get('/courses/{courseId}/grade-items/{gradeItemId}/grade', GradeItemGrading::class)->name('grade-items.grade');

    Route::get('/modules/create/{courseId}', ModuleCreate::class)->name('modules.create');
    Route::get('/modules/{moduleId}/edit', ModuleEdit::class)->name('modules.edit');

    Route::get('/courses/{courseId}/materials', MaterialIndex::class)->name('materials.index');
    Route::get('/courses/{courseId}/materials/create', MaterialsCreate::class)->name('materials.create');

    Route::get('/materials/{id}/edit', MaterialsEdit::class)->name('materials.edit');
    Route::get('/materials/{materialId}', MaterialsShow::class)->name('materials.show');




    Route::prefix('instructors/announcements')->group(function () {
        Route::get('/index', InstructorAnnouncementIndex::class)->name('announcements.index');
        Route::get('/edit/{id}', AnnouncementEdit::class)->name('announcements.edit');
        Route::get('/create', AnnouncementCreate::class)->name('announcements.create');
    });
});
