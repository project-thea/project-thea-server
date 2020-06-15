<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'details', 'status'
    ];
}
