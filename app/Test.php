<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function disease()
    {
        return $this->belongsTo(Disease::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
