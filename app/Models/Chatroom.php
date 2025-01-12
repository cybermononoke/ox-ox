<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chatroom extends Model
{
    protected $fillable = ['name', 'created_by'];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'chatroom_students')
            ->withTimestamps();
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'course_id');
    }
}
