<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampleTracking extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * A sample tracker has many sample tests.
     */
    public function sample_test_trackings()
    {
        return $this->hasMany(SampleTestTracking::class);
    }
}
