<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Mews\Purifier\Facades\Purifier;

class Question extends Model
{
    protected $fillable = ['quiz_id', 'question_text', 'points'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function getQuestionTextAttribute($value)
    {
        return Purifier::clean($value);
    }
}
