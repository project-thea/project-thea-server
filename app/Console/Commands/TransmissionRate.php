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

class TransmissionRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transmission-rate:compute {date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compute the THEA-C19 transmission rate';
	
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
	 * Gets a red hotspot and finds out the number of drivers that have turned positive 
	 * within 14 days
     *
     * @return int
     */
    public function handle()
    {
		$process_date =  $this->argument('date');
		
		$DAYS = 14;
		
		$hotspots = DB::table('risk_assessment')
		->select('hotspots.drivers', 'hotspots.date_time', 'hotspots.id')
		->join('hotspots', 'hotspots.id', '=', 'risk_assessment.hotspot_id')
		->get();
		
		foreach($hotspots as $hotspot){
			$num_exposed = substr_count($hotspot->drivers, ",") - 1;
			
			if($num_exposed == 0) continue;
			
			$drivers =  "'" . str_replace(",",  "','", $hotspot->drivers) . "'" ;
			$date_time = Carbon::createFromFormat('Y-m-d H:i:s', $hotspot->date_time)->toDateTimeString();
			$end_date = Carbon::now()->addDays($DAYS)->toDateTimeString();
			
			//get positives in the next 14 days 
			$infection_count = DB::table('tests')
				->whereRaw("unique_id IN ({$drivers})")
				->where('status_id', 2) //positive test id is 2
				->whereRaw("test_date > '{$date_time}' AND test_date <= '{$end_date}'")
				->count();
				
			try {
				DB::table('transmission_rate')->insert([
					[
						'hotspot_id' => $hotspot->id, 
						'date_time' => $hotspot->date_time,
						'num_exposed' => $num_exposed,
						'num_infected' => $infection_count,
						'trx_rate'	=> $num_exposed == 0 ? 0 : (int)$infection_count/(int)$num_exposed
					]
				]);
			}catch(Exception $e){
				
			}
				
		}
		
        return 0;
    }
	

	
}