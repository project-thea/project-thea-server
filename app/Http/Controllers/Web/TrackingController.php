<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\SubjectTracking;

class TrackingController extends Controller
{
	public function index(Request $request)
	{
		$data = $request->all();
		
		$locations = [];
		
		if(isset($data['uids'])){
			$uids = explode(",", $data['uids']);
			$start_date = !isset($data['start_date']) ? date('Y-m-d') :$data['start_date'] ; 
			$end_date = !isset($data['end_date']) ? date('Y-m-d') :$data['end_date'] ; 
			
			foreach($uids as $uid){
				$user_locations =  SubjectTracking::select('latitude', 'longitude', 'created_at as date_time')
					->where('unique_id', $uid)
					->where('created_at', '>=', $start_date)
					->where('created_at', '<', $end_date)
					->orderBy('created_by', 'desc')
					->get();
					
				$locations[$uid] = $user_locations; 
			}
		}
		
		return Inertia::render('Tracking/Index', [
			'data' => [],
			'locations' => $locations,
			'uids' => isset($data['uids']) ? $data['uids'] : null,
			'start_date' => isset($data['start_date']) ? $data['start_date'] : null,
			'end_date' => isset($data['end_date']) ? $data['end_date'] : null
		]);
	}
}
