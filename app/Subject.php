<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'nationality',
        'date_of_birth',
        'phone',
        'next_of_kin',
        'next_of_kin_phone',
        'id_number',
        'id_type',
    ];

    /**
     * A subject consists of many tests.
     */
    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    /**
     * A subject consists of many subject trackers.
     */
    public function subject_trackings()
    {
        return $this->hasMany(SubjectTracking::class);
    }
}
