<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampleTestTracking extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get a sample test that belongs to a sample tracker.
     */
    public function sample_tracking()
    {
        return $this->belongsTo(SampleTracking::class, 'sample_tracking_id');
    }

    /**
     * Get a sample test that belongs to a test.
     */
    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id');
    }
}
