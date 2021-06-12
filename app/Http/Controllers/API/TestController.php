<?php

namespace App\Http\Controllers\API;

use App\Helpers\APIHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\TestResource;
use Illuminate\Http\Request;
use App\Models\Test;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    public const RECORDS_PER_PAGE = 20;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tests = Test::select('tests.*', 'subjects.first_name', 'subjects.last_name', 'diseases.name')
            ->leftJoin('subjects', 'tests.subject_id', '=', 'subjects.id')
            ->leftJoin('diseases', 'tests.disease_id', '=', 'diseases.id')
            ->orderBy('tests.test_date', 'ASC')
            ->paginate(self::RECORDS_PER_PAGE);

        $testsCollection = TestResource::collection($tests);
        $apiResponse = APIHelpers::formatAPIResponse(false, 'Tests retrieved successfully', $testsCollection);
        return response()->json($apiResponse, 200);
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
            'disease_id' => 'exists:App\Disease,id',
            'subject_id' => 'exists:App\Subject,id',
            'test_date' => 'required|date',
            'status' => 'required|string|max:10',
            'status_update_date' => 'date',
            'created_with' => 'string|max:4',
            'updated_with' => 'string|max:4',
        ];

        $validator = Validator::make($data, $validateData);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $tests = Test::create($data);
        $testsResource = new TestResource($tests);
        $apiResponse = APIHelpers::formatAPIResponse(false, 'Test created successfully', $testsResource);
        return response()->json($apiResponse, 201);
    }

    /**
     * Display the specified Test.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        $testResource = new TestResource($test);
        $apiResponse = APIHelpers::formatAPIResponse(false, 'Test retrieved successfully', $testResource);
        return response()->json($apiResponse, 200);
    }

    /**
     * Update the specified Test in storage.
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
            $apiResponse = APIHelpers::formatAPIResponse(true, 'Test update failed', null);
            return response()->json($apiResponse, 400);
        }

        $apiResponse = APIHelpers::formatAPIResponse(false, 'Test updated successfully', $updatedTest);
        return response()->json($apiResponse, 200);
    }

    /**
     * Remove the specified Test from storage.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        $test->delete();
        $apiResponse = APIHelpers::formatAPIResponse(false, 'Test deleted successfully', null);
        return response()->json($apiResponse, 204);
    }
}
