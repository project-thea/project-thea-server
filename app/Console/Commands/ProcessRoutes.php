<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\Test;
use App\Models\DailyMovement;
use App\Models\Subject;
use Carbon\Carbon;
use App\Helpers\PolylineOSRM;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class ProcessRoutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tracking:process-routes {date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process driver routes';

    protected $valhalla_host = 'thea_valhalla:8002';
	
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
		
		$this->valhalla_host = env("VALHALLA_HOST", "thea_valhalla:8002");
		Log::info('VALHALLA_HOST: '. $this->valhalla_host);
    }




    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
		$process_date =  $this->argument('date');
		
		//$process_date = '2022-01-18';
		//$unique_id = '0c29287c-9259-4b8e-bbb9-ce759ba45ced';
		//$subject_id = 488;
		
		$drivers = DB::table('subject_trackings')
			->select('unique_id')
			->whereRaw("DATE_FORMAT(date_time,'%Y-%m-%d') = '$process_date'")
			->whereRaw('latitude > -1.488') //min latitude
			->whereRaw('latitude < 4.2365') //max latitude
			->whereRaw('longitude < 35.156') //max longitude 
			->whereRaw('longitude > 29.454') //min longitude
			->distinct()
			->get();
			
		foreach($drivers as $driver){
			$unique_id = $driver->unique_id;
			$subject_id = 0;
			Log::info(" unique_id:" . $unique_id . " subject_id:" . $subject_id);
			$this->process_routes($process_date, $unique_id, $subject_id);
		}

        return 0;
    }
	
	public function process_routes($process_date, $unique_id, $subject_id){
		
		$POE_LIST = [
			'nimule' => [3.5724, 32.056],
			'mpodwe' => [0.04334,29.72176], //customs office
			'mutukula' => [-1.00004,31.41696],
			'malaba' => [0.6392,34.2613],
			'nebi' => []
		];
		
		$segments = [];
		$segment_gaps = [];
		
		//Get locations 
		$locations = DB::table('subject_trackings')
			->select('latitude', 'longitude', 'date_time')
			->where('unique_id', $unique_id)
			->whereRaw('latitude > -1.488') //min latitude
			->whereRaw('latitude < 4.2365') //max latitude
			->whereRaw('longitude < 35.156') //max longitude 
			->whereRaw('longitude > 29.454') //min longitude
			->whereRaw("DATE_FORMAT(date_time,'%Y-%m-%d') = '$process_date'")
			->orderBy('date_time', 'asc')
			->get()
			->toArray();
			
		//echo print_r( $locations, true);
		//Log::info(DB::table('subject_trackings')
		//	->select('latitude', 'longitude', 'date_time')
		//	->where('unique_id', $unique_id)
		//	->whereRaw('latitude > -1.488') //min latitude
		//	->whereRaw('latitude < 4.2365') //max latitude
		//	->whereRaw('longitude < 35.156') //max longitude 
		//	->whereRaw('longitude > 29.454') //min longitude
		//	->whereRaw("DATE_FORMAT(date_time,'%Y-%m-%d') = '$process_date'")
		//	->orderBy('date_time', 'asc')->toSql());
		
		$loc_len = count($locations);
		$cnt = 0;
		$segment=[];
		for($i=0; $i < $loc_len; $i++){
			$location = $locations[$i];
			array_push($segment, [$location->latitude, $location->longitude, $location->date_time]);
			//echo 'location: latitude=' . $location->latitude . ' , longitude=' . $location->longitude; 
			if($i == 0) { 
				continue;
			}
			
			$prev_location = $locations[$i - 1];
			
			$distance = \GeometryLibrary\SphericalUtil::computeDistanceBetween(
				['lat' => $prev_location->latitude, 'lng' => $prev_location->longitude], 
				['lat' => $location->latitude, 'lng' => $location->longitude]
			);
			
			$dt_start = Carbon::createFromFormat('Y-m-d H:i:s', $prev_location->date_time);
			$dt_end = Carbon::createFromFormat('Y-m-d H:i:s', $location->date_time);
			$time_diff = $dt_start->diffInSeconds($dt_end);
			//echo "timeDiff: $time_diff distance: $distance\n";
			//echo "min: " . 15*60 . "\n";
			
			//get routing from valhalla if distance is greater than a kilometer 
			//time different is greater than 15 minutes
			if($distance > 1000 && (int)$time_diff > 900){
				unset($segment[$i]); //delete previous element 
				
				array_push($segments, $segment);
				$segment = [[$location->latitude, $location->longitude, $location->date_time]];
				
			}else{
			}
			
			//echo 'prev_location: [' .$prev_location->latitude . ' , ' . $prev_location->longitude . "]\n";
			//echo 'curr_location: [' .$location->latitude . ' , ' . $location->longitude . "]\n";
			//echo 'computeDistanceBetween: ' . $distance . "\n";
			//echo "----------------------------------------------\n";
			
			//if($i == 10) break;
		}
		
		if( count($segment) > 0 ) array_push($segments, $segment);

        Log::info( 'SEGMENTS: ' . print_r($segments, true));
  
		//For each segment, match points to get routes on road 
		$num_segments  = count($segments);
		for($i = 0; $i < $num_segments; $i++){
			$polyline = $segments[$i];
			
			$matched_segment = $this->map_to_road($polyline);
			
			if($matched_segment){
			  $daily_movt = DailyMovement::create([
			  	'unique_id' => $unique_id,
			  	'subject_id' => $subject_id,
			  	'shape' => $matched_segment,
				'day' => $process_date
			  ]);
			}
		}
		
		//connect the segments 
		for($i = 0; $i < $num_segments-1; $i++){
			$polyline = $segments[$i];
			$next_polyline = $segments[$i+1];
			
			$polyline_len = count($polyline);
			$first_point = $polyline[$polyline_len-1];
			$next_point = $next_polyline[0];
			
			array_push($segment_gaps, [$first_point, $next_point]);
			
		}
		
		//Print segment gaps
		echo print_r($segment_gaps, true) . "\n";
		
		//Connect/fill the segments with the valhalla routing api 
		$num_gaps = count($segment_gaps);
		for($i=0; $i < $num_gaps; $i++){
			$gap = $segment_gaps[$i];
			$route = $this->get_route($gap[0], $gap[1]);
			
			if($route){
			  $daily_movt = DailyMovement::create([
			  	'unique_id' => $unique_id,
			  	'subject_id' => $subject_id,
			  	'shape' => $route,
				'day' => $process_date
			  ]);
			}
		}
		
		$num_segments  = count($segments);
		for($i=0; $i < $num_segments; $i++){
			$segment = $segments[$i];
			$len = count($segment);
			
			$route = $this->extend_route($segment[0], $segment[$len-1]);
			
			if($route){
			  $daily_movt = DailyMovement::create([
			  	'unique_id' => $unique_id,
			  	'subject_id' => $subject_id,
			  	'shape' => $route,
				'day' => $process_date
			  ]);
			}
		}
		
		
		//@TODO: Extra polate movement in the future depending on location and time 
		
		//Update the locations in the process_locations table 
		
		//echo print_r($drivers, true);
		
	}
	
	/*
	* Return ployline 
	*/
	function map_to_road($polyline){
		try{
			$clean_polyline = array_map(function($arr){
				return [$arr[0], $arr[1]];
			}, $polyline);
			//echo print_r( $clean_polyline, true);
			$encoded_polyline = PolylineOSRM::encode($clean_polyline);

			//echo "encoded2======\n";
			//echo $encoded2 ."\n";
			
			//echo print_r(PolylineOSRM::decode('}zokEkxme|@fUiSf\\yZtwBsnB'), true);
			//echo print_r(PolylineOSRM::pair(PolylineOSRM::decode('}zokEkxme|@fUiSf\\yZtwBsnB')), true);
			
			$response = Http::post( $this->valhalla_host . '/trace_attributes', [
				"encoded_polyline" => $encoded_polyline,
				"costing" => "auto",
				"shape_match" => "map_snap", 
				"search_radius"=> "100", 
				"filters" => ["attributes" => ["shape"], "action"=> "include"]
			]);
			
			$resp_obj = $response->json();
			Log::info($response->body());

			if(array_key_exists("error_code", $resp_obj)){
				Log::error('Error' . $resp_obj['error'] );
				return null;
			}
			
			//Log::info("shape: " . $resp_obj['shape']);
			if($resp_obj['shape']){
				return $resp_obj['shape'];
			}
			
			return null;
			//echo print_r($response->json(), true);
			
			//return $response;
		}catch(Exception $e){
			Log::error($e->getMessage());
		}
		
		return null;
	}
	
	function get_route($start_point, $end_point){
		
		$response = Http::get( $this->valhalla_host . 
		'/optimized_route?json={"locations":[{"lat":' . $start_point[0] . ',"lon":'. $start_point[1] .'},{"lat":' . $end_point[0] . ',"lon": ' . $end_point[1] . '}],"costing":"auto"}');
		
		$resp_obj = $response->json();
		
		Log::info($response->body());
		if(array_key_exists("error_code", $resp_obj)){
			Log::error('Error' . $resp_obj['error'] );
			return null;
		}
			
		if($resp_obj['trip']['status'] == 0){
			return $resp_obj['trip']['legs'][0]['shape'];
		}
		
		return null;
	}
	
	//
	function extend_route($start_point, $end_point){
		$POE_LIST = [
			'nimule' => [3.5724, 32.056],
			'mpodwe' => [0.04334,29.72176], //customs office
			'mutukula' => [-1.00004,31.41696],
			'malaba' => [0.6392,34.2613],
			'nebi' => [2.3778,31.0296],
			'Kaya' => [3.5395,30.8838],
			'Kampala' => [2.3778,31.0296],
			'Gatuna' => [2.3778,31.0296]
		];
		
		$poe = null;
		$end = null;
		$min_dist = 100000000;
		$bearing_diff = 180;
		
		foreach( $POE_LIST as $poe_name => $poe_pos){
			$poe = $poe_name;
			$end = $poe_pos;
			
			$heading_peo = \GeometryLibrary\SphericalUtil::computeHeading(
                ['lat' => $end_point[0], 'lng' => $end_point[1]], 
                ['lat' => $poe_pos[0],   'lng' => $poe_pos[1]]);	
				
			$heading_start_end = \GeometryLibrary\SphericalUtil::computeHeading(
                ['lat' => $end_point[0], 'lng' => $end_point[1]], 
                ['lat' => $poe_pos[0],   'lng' => $poe_pos[1]]);	
				
				
			$distance = \GeometryLibrary\SphericalUtil::computeDistanceBetween(
                ['lat' => $end_point[0], 'lng' => $end_point[1]], 
                ['lat' => $poe_pos[0],   'lng' => $poe_pos[1]]);
				

			if( $min_dist > $distance ){
			    $min_dist = $distance;
				$end = $poe_pos;
			}

			$new_bearing_dff = abs($heading_peo-$heading_start_end);
			//if( $bearing_diff > $new_bearing_dff ){
			//	$bearing_diff = $new_bearing_dff;
			//	$end = $poe_pos;
			//}
			
		}
		
		if($min_dist == 100000000) return null;
		
		$start = $end_point;
		
		return $this->get_route($start, $end);
	}
	
}