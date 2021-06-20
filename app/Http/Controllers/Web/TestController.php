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

class TestController extends Controller
{
    /**
     * Get tests page info
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function index(Request $request)
	{
		$query_params = $request->all();
		
		$tests = [];
		
		if(isset($query_params['search'])){
			$tests = DB::table('tests')->where('name', 'LIKE', '%' . $query_params['search'] . '%')
						->get();
		}else{
			$tests = Test::all();
		}

		return Inertia::render('Tests/Index', [
			'filters' => [
				'search' => isset($query_params['search']) ? $query_params['search'] : ''
			],
			'tests' => [
				'data' => $tests
			]
		]);
	}

}