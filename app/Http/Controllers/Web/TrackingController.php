<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\SubjectTracking;
use App\Models\Hotspot;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;


class TrackingController extends Controller
{
	public function index(Request $request)
	{
		$data = $request->all();
		
		$locations = [];
		$drivers = [];
		$hotsports = [];
		$uid_list = [];
		$hotspots = [];
		
		$default_start_date = date('Y-m-d');
		$default_end_date = date('Y-m-d');

		if(env('DEMO_MODE')){
			$default_start_date = '2023-03-01';
			$default_end_date = '2023-03-31';
		}
		$start_date = !isset($data['start_date']) ? $default_start_date :$data['start_date'] ; 
		$end_date = !isset($data['end_date']) ? $default_end_date :$data['end_date'] ; 
		
		$end_date_for_qry = $end_date;
		
		if($start_date == $end_date){
			$end_date_for_qry = $end_date .' 23:59:00';
		}
		
		$hotspots = Hotspot::select('latitude', 'longitude', 'hotspots.date_time', 'risk_assessment.id', 'hotspots.drivers', 'tests.unique_id')
		->leftJoin('risk_assessment', 'risk_assessment.hotspot_id', '=', 'hotspots.id')
		->leftJoin('tests', 'tests.id', '=','risk_assessment.test_id')
		->where('hotspots.date_time', '>=', $start_date)
		->where('hotspots.date_time', '<', $end_date_for_qry)
		->get()
		->toArray();
		
		
		//Return uids 
		if(isset($data['uids'])){
			$uid_list = explode(",", $data['uids']);
		}else{
			$uids_list = SubjectTracking::select('unique_id')
				->where('date_time', '>=', $start_date)
				->where('date_time', '<', $end_date_for_qry)
				->whereRaw('latitude > -1.488') //min latitude
				->whereRaw('latitude < 4.2365') //max latitude
				->whereRaw('longitude < 35.156') //max longitude 
				->whereRaw('longitude > 29.454') //min longitude
				 ->distinct()
				->get()
				->toArray();
				
			
			foreach($uids_list as $uid){
				//Log::info("$uid" . $uid['unique_id']);
				array_push($uid_list, $uid['unique_id'] );
			}
			$data['uids'] = implode(',', $uid_list);
		}
		
		return Inertia::render('Tracking/Index', [
			'data' => [],
			'hotspots' => $hotspots,
			'locations' => [],
			'uids' => isset($data['uids']) ? $data['uids'] : "",
			'uid_list' => $uid_list,
			'start_date' => $start_date, //isset($data['start_date']) ? $data['start_date'] : null,
			'end_date' => $end_date, // isset($data['end_date']) ? $data['end_date'] : null,
			'demo_mode' => env('DEMO_MODE', false)
		]);
		
	}
	
	public function get_locations(Request $request){
		$data = $request->all();
		
		$locations = [];
		$drivers = [];
		$hotsports = [];
		
		$hotspots = [];
		if(isset($data['uids'])){
			
		}else{
			$data['uids'] = "";
			$uids = [];
			$locations = [];
			
			$uids_list = SubjectTracking::select('unique_id')
				->where('date_time', '>=', $start_date)
				->where('date_time', '<', $end_date)
				 ->distinct()
				->get()
				->toArray();
				
			
			foreach($uids_list as $uid){
				//Log::info("$uid" . $uid['unique_id']);
				array_push($uids, $uid['unique_id'] );
			}
			
			$data['uids'] = implode(',', $uids);
			
		}
		
		//Log::info('ddd:' . print_r($locations, true));
		return Inertia::render('Tracking/Index', [
			'data' => [],
			'hotspots' => $hotspots,
			'locations' => $locations,
			'uids' => isset($data['uids']) ? $data['uids'] : null,
			'start_date' => isset($data['start_date']) ? $data['start_date'] : null,
			'end_date' => isset($data['end_date']) ? $data['end_date'] : null
		]);
	}
	
	public function get_driver_paths($user_locations){
		//Log::info($user_locations);
		if(count($user_locations) == 0) { return null;}
		try {
			$user_coords = array_map(function($v){ return ['lat' => $v['latitude']*10, 'lng' => $v['longitude']*10];}, $user_locations);
			//Log::info($user_coords);
		
			$encoded_polyline = \GeometryLibrary\PolyUtil::encode($user_coords);

			$response = Http::post('http://thea_valhalla:8002/trace_attributes', [
				"encoded_polyline"=> $encoded_polyline,
				"costing" => "auto",
				"shape_match" => "map_snap", 
				"search_radius"=> "100", 
				"filters" => ["attributes" => ["shape"], "action"=> "include"]
			]);
			
			if($response->status() == 200){
				return $response->object()->shape;
			}
			//return $encoded_polyline;
		}catch(Exception $e){
			Log::info($e);
		}
		
		return null;
	}
}
