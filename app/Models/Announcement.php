<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['title', 'content', 'course_id'];

    /**
     * The course that the announcement belongs to.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
