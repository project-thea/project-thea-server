<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyMovement extends Model
{
    use HasFactory;
    
    protected $guarded = [];
	
	  protected $table = 'daily_movements';
}
