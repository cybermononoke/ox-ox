<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class Course extends Model
{
    protected $fillable = ['title', 'description', 'instructor_id', 'credits', 'duration', 'prerequisite_id'];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'course_students')
            ->withPivot(['grade', 'letter_grade', 'comments'])
            ->withTimestamps();
    }

    public function gradeItems(): HasMany
    {
        return $this->hasMany(GradeItem::class);
    }

    public function courseStudent(): HasOne
    {
        return $this->hasOne(CourseStudent::class)
            ->where('student_id', Auth::user()->student->id);
    }

    public function modules(): HasMany
    {
        return $this->hasMany(Module::class);
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class);
    }

    public function materials(): HasMany
    {
        return $this->hasMany(CourseMaterial::class);
    }

    public function prerequisite(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_prerequisites', 'course_id', 'prerequisite_id');
    }

    public function assessments(): HasMany
    {
        return $this->hasMany(Assessment::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class); 
    }

    public function batches()
    {
        return $this->hasMany(Batch::class);
    }

    public function chatrooms(): BelongsToMany
    {
        return $this->belongsToMany(Chatroom::class, 'chatroom_courses'); // 'chatroom_courses' is the pivot table
    }

}
