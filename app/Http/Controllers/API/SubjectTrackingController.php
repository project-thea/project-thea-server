<?php

namespace App\Http\Controllers\API;

use App\Helpers\APIHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubjectTrackingResource;
use App\Models\SubjectTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SubjectTrackingController extends Controller
{
     /**
     * Display a listing of the subject tracking.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjectTrackings = SubjectTracking::select(
            'subject_id',
            'latitude',
            'longitude',
            'unique_id',
            'date_time'
        )->get();

        $subjectTrackingsCollection = SubjectTrackingResource::collection($subjectTrackings);
        $apiResponse = APIHelpers::formatAPIResponse(false, 'Subject trackings retrieved successfully', $subjectTrackingsCollection);
        return response()->json($apiResponse, 200);
    }

    /**
     * Store a newly created subject tracking in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		try{
			$data = $request->all();

			$validateData = [
				//'subject_id' => 'exists:App\Models\Subject,id',
				'latitude' => 'numeric',
				'longitude' => 'numeric',
				'unique_id' => 'string',
				'date_time' => 'date_format:Y-m-d H:i:s'
			];

			$validator = Validator::make($data, $validateData);

			if ($validator->fails()) {
				return response(['error' => $validator->errors(), 'Validation Error']);
			}

			$subjectTrackings = SubjectTracking::create($data);
			$subjectTrackingsResource = new SubjectTrackingResource($subjectTrackings);
			$apiResponse = APIHelpers::formatAPIResponse(false, 'Subject trackings created successfully', $subjectTrackingsResource);
			return response()->json($apiResponse, 201);
		}catch(Exception $e){
			Log::info($e->getMessage());
			return response(['error' => [], 'Error']);
		}
    }

    /**
     * Store a batch of user locations.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_batch(Request $request)
    {
        $data = $request->all();

        $validateData = [
            '*.subject_id' => 'exists:App\Models\Subject,id',
            '*.latitude' => 'numeric',
            '*.longitude' => 'numeric',
            '*.unique_id' => 'string',
            '*.date_time' => 'date_format:Y-m-d H:i:s'
        ];

        $validator = Validator::make($data, $validateData);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $subjectTrackings = SubjectTracking::insert($data);
        $apiResponse = APIHelpers::formatAPIResponse(false, 'Subject trackings created successfully', null);
        return response()->json($apiResponse, 201);
    }
	
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	
    /**
     * Tracking anonymously
     *
     * @return \Illuminate\Http\Response
     */
    public function track_anonymously(Request $request)
	{
		//$out = new \Symfony\Component\Console\Output\ConsoleOutput();
		//$out->writeln(print_r($request->all(), true));
		
		return $this->store($request);
	}
	
    /**
     * Tracking anonymously
     *
     * @return \Illuminate\Http\Response
     */
    public function store_offline_locations(Request $request)
	{
		$out = new \Symfony\Component\Console\Output\ConsoleOutput();
		//$out->writeln(print_r($request->all(), true));
		
		return $this->store_batch($request);
	}
	
	public function get_movements(Request $request){
		$unique_id = $request->input('unique_id');
		$page  = $request->input('page', 1);
		$limit = $request->input('limit', 2);
		$start_date = $request->input('start_date', date('Y-m-d 00:00'));
		$end_date = $request->input('end_date', date('Y-m-d 23:59'));
		
		//when the start and end date are the same, 
		//set to end date time to 23:59
		if($start_date == $end_date){
			$end_date = $start_date . ' 23:59';
		}
		
		$offset = (int)$page * (int)$limit;
		$movements = DB::table('daily_movements')
		->select('shape')
		->where('unique_id', $unique_id)
		->offset($offset)->limit($limit)
		->whereRaw("day >= '$start_date'")
		->whereRaw("day < '$end_date'")
		->distinct()
		->get()
		->toArray()
        ;
        
		
		$total = DB::table('daily_movements')
		->select('shape', 'unique_id')
		->where('unique_id', $unique_id)
		->whereRaw("day >= '$start_date'")
		->whereRaw("day < '$end_date'")
		->distinct()
		->count();

		return response()->json([
			'data' => $movements,
			'total' => (int)$total,
			'page' => $page,
			'next_page' => $page + 1,
			'limit' => (int)$limit,
			'start_date' => $start_date,
			'end_date' => $end_date
		], 201);
	}
}
