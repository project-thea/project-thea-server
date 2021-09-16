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
    public function index(Request $request, Questionnaire $questionnaire)
    {
        $validationRule = [
            'questionnaire_id' => 'exists:App\Models\Questionnaire,id',
        ];

        $validateData = $request->validate($validationRule);

        $validateData['questionnaire_id'] = $questionnaire->id;

        $questions = Question::paginate(self::RECORDS_PER_PAGE);

        $questions = Question::select('questions.*', 'questionnaires.name', 'questionnaires.description')
            ->leftJoin('questionnaires', 'questions.questionnaire_id', '=', 'questionnaires.id')
            ->orderBy('questions.id', 'ASC')
            ->paginate(self::RECORDS_PER_PAGE);

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
    public function store(Request $request, Questionnaire $questionnaire)
    {
        $validationRules = [
            'questionnaire_id' => 'exists:App\Models\Questionnaire,id',
            'datatype_id' => 'exists:App\Models\DataType,id',
            'title' => 'required|string|max:55',
            'attributes' => 'json',
            'created_by' => 'integer',
            'updated_by' => 'integer'
        ];

        $validateData = $request->validate($validationRules);

        $validateData['created_by'] = Auth::id();
        $validateData['updated_by'] = Auth::id();
        $validateData['questionnaire_id'] = $questionnaire->id;

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
    public function show(Request $request, Questionnaire $questionnaire, Question $question)
    {
        $validationRules = [
            'questionnaire_id' => 'exists:App\Models\Questionnaire,id',
        ];

        $validateData = $request->validate($validationRules);

        $validateData['questionnaire_id'] = $questionnaire->id;

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
    public function update(Request $request, Questionnaire $questionnaire, Question $question)
    {
        $validationRules = [
            'questionnaire_id' => 'exists:App\Models\Questionnaire,id',
            'title' => 'required|string|max:55',
            'datatype_id' => 'exists:App\Models\DataType,id',
            'attributes' => 'json',
            'updated_by' => 'integer'
        ];

        $validateData = $request->validate($validationRules);

        $validateData['questionnaire_id'] = $questionnaire->id;
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
    public function destroy(Request $request, Questionnaire $questionnaire, Question $question)
    {
        $validationRule = [
            'questionnaire_id' => 'exists:App\Models\Questionnaire,id',
        ];

        $validateData = $request->validate($validationRule);

        $validateData['questionnaire_id'] = $questionnaire->id;

        $question->delete();
        $apiResponse = APIHelpers::formatAPIResponse(false, 'Question deleted successfully', null);
        return response()->json($apiResponse, 200);
    }
}
