<?php

namespace App\Http\Controllers\API;

use App\Helpers\APIHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\SampleTrackingResource;
use App\SampleTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SampleTrackingController extends Controller
{
    /**
     * Display a listing of the sample tracking.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sampleTrackings = SampleTracking::select(
            'latitude',
            'longitude',
            'unique_id',
            'date_time',
            'sample_test_trackings.sample_tracking_id'
        )->leftJoin(
            'sample_test_trackings',
            'sample_trackings.id',
            '=',
            'sample_test_trackings.sample_tracking_id'
        )->get();

        $sampleTrackingsCollection = SampleTrackingResource::collection($sampleTrackings);
        $apiResponse = APIHelpers::createAPIResponse(false, 'Sample trackings retrieved successfully', $sampleTrackingsCollection);
        return response()->json($apiResponse, 200);
    }

    /**
     * Store a newly created sample tracking in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validateData = [
            'latitude' => 'string|min:4',
            'longitude' => 'string|min:4',
            'unique_id' => 'string',
            'date_time' => 'date_format:Y-m-d H:i:s'
        ];

        $validator = Validator::make($data, $validateData);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $sampleTrackings = SampleTracking::create($data);
        $sampleTrackingsResource = new SampleTrackingResource($sampleTrackings);
        $apiResponse = APIHelpers::createAPIResponse(false, 'Sample trackings created successfully', $sampleTrackingsResource);
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
}
