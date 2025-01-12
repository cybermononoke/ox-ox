<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GradeItem extends Model
{
    protected $fillable = [
        'course_id',
        'name',
        'description',
        'max_points',
        'weight',
        'due_date'
    ];

    protected $casts = [
        'due_date' => 'date'
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function studentGradeItems(): HasMany
    {
        return $this->hasMany(StudentGradeItem::class);
    }
}