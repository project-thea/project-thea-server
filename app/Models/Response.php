<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    /**
     * A response belongs to a question.
     */
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
