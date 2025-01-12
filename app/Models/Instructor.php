<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instructor extends Model
{
    public function batches()
    {
        return $this->hasMany(Batch::class);
    }

    protected $fillable = [
        'user_id',
        'avatar'
        // other fillable fields...
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
