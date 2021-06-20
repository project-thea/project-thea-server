<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Test;
use App\Models\Disease;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class TrackingController extends Controller
{
	public function index()
	{
		
		return Inertia::render('Tracking', [
			'data' => []
		]);
	}
}