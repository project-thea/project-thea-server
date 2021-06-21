<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class AnalysisController extends Controller
{
	public function index()
	{
		return Inertia::render('Analysis/Index', [
			'data' => []
		]);
	}
}
