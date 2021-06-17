<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory;

    protected $fillable = [
        'disease_name',
        'description',
    ];

    /**
     * A disease consists of many tests.
     */
    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
