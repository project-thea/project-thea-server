<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampleTracking extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * A sample tracker has many sample test trackers.
     */
    public function sample_test_trackings()
    {
        return $this->hasMany(SampleTestTracking::class);
    }
}
