<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    /**
     * A question belongs to a questionnaire.
     */
    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class, 'questionnaire_id');
    }

    /**
     * A question belongs to a datatype.
     */
    public function datatype()
    {
        return $this->belongsTo(DataType::class, 'datatype_id');
    }
}
