<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    protected $fillable = ['user_id', 'avatar'];

    public function batches(): BelongsToMany
    {
        return $this->belongsToMany(Batch::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_students')
            ->withPivot(['grade', 'letter_grade', 'comments'])
            ->withTimestamps();
    }

    public function gradeItems(): HasMany
    {
        return $this->hasMany(StudentGradeItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class, 'student_id');
    }

    public function chatrooms(): BelongsToMany
    {
        return $this->belongsToMany(Chatroom::class, 'chatroom_students') 
            ->withTimestamps();
    }
}
