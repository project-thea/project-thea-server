<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelpers;
use App\Http\Resources\TestResource;
use App\Test;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $test = Test::select('tests.*', 'subjects.first_name', 'subjects.last_name', 'diseases.name')
            ->leftJoin('subjects', 'tests.subject_id', '=', 'subjects.id')
            ->leftJoin('diseases', 'tests.disease_id', '=', 'diseases.id')
            ->get();

        $testsCollection = TestResource::collection($test);
        $apiResponse = APIHelpers::createAPIResponse(false, 'Tests retrieved successfully', $testsCollection);
        return response()->json($apiResponse, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validateData = [
            'test_date' => 'required',
            'status' => 'required|max:10',
            'status_update_date' => 'required',
        ];

        $validator = Validator::make($data, $validateData);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $tests = Test::create($data);
        $testResource = new TestResource($tests);
        $apiResponse = APIHelpers::createAPIResponse(false, 'Test created successfully', $testResource);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        $test->update($request->all());
        $updatedTest = new TestResource($test);

        if (!$updatedTest) {
            $apiResponse = APIHelpers::createAPIResponse(true, 'Test update failed', null);
            return response()->json($apiResponse, 400);
        }

        $apiResponse = APIHelpers::createAPIResponse(false, 'Test updated successfully', $updatedTest);
        return response()->json($apiResponse, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        $test->delete();
        $apiResponse = APIHelpers::createAPIResponse(false, 'Test deleted successfully', null);
        return response()->json($apiResponse, 200);
    }
}
