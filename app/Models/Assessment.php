<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assessment extends Model
{
    protected $fillable = ['course_id', 'type', 'weight', 'date'];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
