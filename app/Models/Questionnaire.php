<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questionnaire extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'label',
        'description'
    ];

    /**
     * A questionnaire consists of many questions.
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * A questionnaire consists of many responses.
     */
    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
