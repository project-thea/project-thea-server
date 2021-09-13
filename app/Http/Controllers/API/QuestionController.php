<?php

namespace App\Http\Controllers\API;

use App\Helpers\APIHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $validationRules = [
            'questionnaire_id' => 'exists:App\Models\Questionnaire,id',
            'datatype_id' => 'exists:App\Models\DataType,id',
            'title' => 'required|string|max:55',
            'attributes' => 'json',
            'position' => 'integer',
            'created_by' => 'integer',
            'updated_by' => 'integer'
        ];

        $validateData = $request->validate($validationRules);

        $validateData['created_by'] = Auth::id();
        $validateData['updated_by'] = Auth::id();

        $question = Question::create($validateData);
        $questionResource = new QuestionResource($question);
        $apiResponse = APIHelpers::formatAPIResponse(false, 'Question created successfully', $questionResource);
        return response()->json($apiResponse, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function show(Questionnaire $questionnaire, Question $question)
    {
        $questionResource = new QuestionResource($question);
        $apiResponse = APIHelpers::formatAPIResponse(false, 'Question retrieved successfully', $questionResource);
        return response()->json($apiResponse, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Questionnaire  $questionnaire
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Questionnaire $questionnaire, Question $question, Request $request)
    {
        $validationRules = [
            'title' => 'required|string|max:55',
            'attributes' => 'json',
            'position' => 'integer',
            'updated_by' => 'integer'
        ];

        $validateData = $request->validate($validationRules);

        $validateData['updated_by'] = Auth::id();

        $question->update($validateData);
        $updatedQuestion = new QuestionResource($question);

        if (!$updatedQuestion) {
            $apiResponse = APIHelpers::formatAPIResponse(true, 'Question update failed', null);
            return response()->json($apiResponse, 400);
        }

        $apiResponse = APIHelpers::formatAPIResponse(false, 'Question updated successfully', $updatedQuestion);
        return response()->json($apiResponse, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questionnaire $questionnaire, Question $question)
    {
        $question->delete();
        $apiResponse = APIHelpers::formatAPIResponse(false, 'Question deleted successfully', null);
        return response()->json($apiResponse, 200);
    }
}
