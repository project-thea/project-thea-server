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

class RiskAssessment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'risk-assessment:compute {date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compute dialy risk assessment';
	
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
		$MIN_DRIVER_FOR_HOTSPOT = 1; //minimum number of drivers to tag cluster as hotspot
		
		$DAYS_BEFORE = 10;
		$DAYS_AFTER = 10;
		
		$process_date =  $this->argument('date');

		//get 7-th day before and 7-th day after 
		$start_date = date('Y-m-d', strtotime("-{$DAYS_BEFORE} day", strtotime($process_date)));
		$end_date = date('Y-m-d', strtotime("+{$DAYS_AFTER} day", strtotime($process_date)));
		
	    echo "Computing risk assessment {$DAYS_BEFORE} days before and {$DAYS_AFTER} days after {$process_date}" . "\n";
		
		$positive_tests = DB::table('tests')
			->select('id', 'unique_id', 'test_date')
			->whereRaw("DATE_FORMAT(test_date,'%Y-%m-%d') = '$process_date'")
			->where('status_id', 2)
			->orderBy('test_date')
			->get()
			;
		
		if(count($positive_tests) ==  0){
			echo "No positive tests on $process_date \n\n";
			return 0;
		}else{
			echo count($positive_tests) . " positives found on $process_date. \n";
		}
		
		echo "Locating exposed hotspots between $start_date and $end_date" . "\n";
		foreach($positive_tests as $pos){
			//Get exposed hotspots 
			$hotspots =  DB::table('hotspots')
			->where('drivers', 'like',"%{$pos->unique_id}%")
			->where('date_time', '>=', $start_date)
			->where('date_time', '<', $end_date)
			->get()
			->toArray();	
			
			foreach($hotspots as $hotspot){
				echo "Hotspot clustered at ". $hotspot->latitude . ',' . $hotspot->longitude . ' on ' . $hotspot->date_time . "\n" ;
				
				DB::table('risk_assessment')->insert([
					[
					'test_id' => $pos->id, 
					'hotspot_id' => $hotspot->id
					],
				]);
			
			}
	
			if(count($hotspots) == 0){
				echo "No hotspots found. for {$pos->unique_id}\n";
			}else{
				echo count($hotspots) . " hotspots found. \n";
			}
		}
	
		
		echo "\n\n";
        return 0;
    }
	

	
}