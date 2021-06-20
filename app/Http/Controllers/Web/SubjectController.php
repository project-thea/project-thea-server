<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Test;
use App\Models\Disease;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use \Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Get subjects page info
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function index(Request $request)
	{
		$query_params = $request->all();
		
		$subjects = [];
		
		if(isset($query_params['search'])){
			$subjects = DB::table('subjects')->where('first_name', 'LIKE', '%' . $query_params['search'] . '%')
						->get();
		}else{
			$subjects = Subject::all();
		}

		
		
		return Inertia::render('Subjects/Index', [
			'filters' => [
				'search' => isset($query_params['search']) ? $query_params['search'] : ''
			],
			'subjects' => [
				'data' => $subjects
			]
		]);
	}
}