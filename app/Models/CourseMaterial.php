<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseMaterial extends Model
{
    protected $fillable = ['course_id', 'type', 'title', 'url', 'description'];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
