<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'student_id',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    protected $casts = [
        'due_date' => 'date', 
    ];
}
