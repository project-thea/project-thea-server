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

class Hotspots extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hotspots:process {date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process hotspots';

    protected $valhalla_host = 'thea_valhalla:8002';
	
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
		$MAX_CLUSTER_SIZE = 2000; //2000 meters
		$MIN_DRIVER_FOR_HOTSPOT = 5; //minimum number of drivers to tag cluster as hotspot
		
		$process_date =  $this->argument('date');

		$locations = DB::table('subject_trackings')
			->select('latitude', 'longitude', 'unique_id')
			->whereRaw("DATE_FORMAT(date_time,'%Y-%m-%d') = '$process_date'")
			->whereRaw('latitude > -1.488')  //min latitude
			->whereRaw('latitude < 4.2365')  //max latitude
			->whereRaw('longitude < 35.156') //max longitude 
			->whereRaw('longitude > 29.454') //min longitude
			->orderBy('date_time')
			->get()
			->toArray()
			;

		
		$clusters = [];
		$cluster_data = [];
		$cluster_center= [];
		$location_list = $locations;
		
		
		$current_cluster = '';
		
		while(count($location_list) > 0){
			
			//Reset array index
			$location_list = array_values($location_list);

			//cluster name 
			$cluster_name = 'cluster-' . count($clusters);
			$current_cluster = $cluster_name;
			
			echo 'Processing cluster: ' . $cluster_name  . ' location_size:' . count($location_list) . "\n";
			
			//update cluster name
			array_push($clusters, $cluster_name);
			
			//echo print_r( $location_list, true);
			
			//Add location to cluster locations
			$cluster_data[$cluster_name]['locations']=[$location_list[0]];
			
			//set cluster center
			$cluster_data[$cluster_name]['centre'] = [$location_list[0]->latitude, $location_list[0]->longitude];

			//Remove the first location from the list and reset the indices
			unset($location_list[0]);
			$location_list = array_values($location_list);
			
			
			$iter_cnt = 0;
			foreach ($location_list as $location){
				$iter_cnt ++;
				
				//get center 
				$centre = $cluster_data[$current_cluster]['centre'];
				
				//echo print_r($centre, true);
				
				//get next location distance from most recent location
				$distance = \GeometryLibrary\SphericalUtil::computeDistanceBetween(
					['lat' => $centre[0], 'lng' => $centre[1]], 
					['lat' => $location->latitude, 'lng' => $location->longitude]
				);
				
				
				//add location to cluster if it within MAX_CLUSTER_SIZE of the cluster centre
				if($distance <= $MAX_CLUSTER_SIZE){
					//echo 'distance:  ' . $distance . "distace is less that 1km\n";
					array_push($cluster_data[$cluster_name]['locations'], $location);

					//Compute new cluster centre 
					$cluster_data[$current_cluster]['centre'] 
						= [  ($centre[0] + $location->latitude)/2 , 
							 ($centre[1] + $location->longitude)/2 ];
				
					
					//remove location from $location_list
					unset($location_list[$iter_cnt-1]);
				}

			}
		}
		
		//Log::info($cluster_data);
		
		//Get unique drivers in each cluster 
		foreach($clusters as $cluster){
			$cluster_data[$cluster]['drivers']
				= $this->get_unique_drivers_in_cluster($cluster_data[$cluster]['locations']);
			$cluster_data[$cluster]['drivers_cnt'] = count($cluster_data[$cluster]['drivers']);
		}
		
		//echo print_r( array_values($clusters), true);
		foreach($clusters as $cluster){
			$centre = $cluster_data[$cluster]['centre'];
			$driver_count = count($cluster_data[$cluster]['drivers']);
			echo 'cluster name: ' . $cluster . 
				' cluster_center: ' . $centre[0] . ',' . $centre[1]  . 
				' driver count: ' . $driver_count . "\n";
				
			$drivers_str = implode(',', $cluster_data[$cluster]['drivers']);
			
			
			//skip hotspots with less than MIN_DRIVER_FOR_HOTSPOT
			//@TODO: Compare this with the max driver count in the days hotspots
			if($driver_count < $MIN_DRIVER_FOR_HOTSPOT) continue;

			//Save hotspots in db 
			DB::table('hotspots')->insert([
				[
				'latitude' => $centre[0], 
				'longitude' => $centre[1], 
				'date_time' => $process_date, 
				'strength' => $driver_count,
				'drivers' => $drivers_str
				],
			]);

		}
		

		
        return 0;
    }
	
	function get_unique_drivers_in_cluster($locations){
		$cnt = 0;
		$drivers = [];
		foreach($locations as $location){
			if(!in_array($location->unique_id, $drivers)){ array_push($drivers, $location->unique_id); }
		}
		return $drivers;
	}

	
}