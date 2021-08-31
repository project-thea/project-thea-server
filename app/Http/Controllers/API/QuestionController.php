<?php

namespace App\Http\Controllers\API;

use App\Helpers\APIHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public const RECORDS_PER_PAGE = 20;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::paginate(self::RECORDS_PER_PAGE);
        $questionsCollection = QuestionResource::collection($questions);
        $apiResponse = APIHelpers::formatAPIResponse(false, 'Questions retrieved successfully', $questionsCollection);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $questionResource = new QuestionResource($question);
        $apiResponse = APIHelpers::formatAPIResponse(false, 'Question retrieved successfully', $questionResource);
        return response()->json($apiResponse, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        $apiResponse = APIHelpers::formatAPIResponse(false, 'Question deleted successfully', null);
        return response()->json($apiResponse, 200);
    }
}
