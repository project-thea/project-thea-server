<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'dob', 'phone', 'nok_name', 'nok_phone'
    ];
}
