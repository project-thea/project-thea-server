<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectTracking extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * A subject tracker belongs to a subject.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
