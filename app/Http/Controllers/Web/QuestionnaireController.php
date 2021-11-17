<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DataType;
use App\Models\Question;
use App\Models\Questionnaire;
use Inertia\Inertia;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class QuestionnaireController extends Controller
{
    public const NUMBER_OF_RECORDS = 5;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query_params = $request->all();
        $trashedQuestionnaires = Questionnaire::onlyTrashed()->latest()->paginate(self::NUMBER_OF_RECORDS);

        if (isset($query_params['search'])) {
            $questionnaires = Questionnaire::query()
                ->where('label', 'LIKE', '%' . $query_params['search'] . '%')
                ->paginate(self::NUMBER_OF_RECORDS);
        } else {
            $questionnaires = Questionnaire::orderBy('id', 'desc')->paginate(self::NUMBER_OF_RECORDS);
        }

        return Inertia::render('Questionnaires/Index', [
            'filters' => [
                'search' => isset($query_params['search']) ? $query_params['search'] : ''
            ],
            'questionnaires' => $questionnaires,
            'trashedQuestionnaires' => $trashedQuestionnaires
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Questionnaires/Create');
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

        $validationRules = [
            'label' => 'required|string|max:55',
            'description' => 'required|string|max:250',
        ];

        $validateData = Validator::make($data, $validationRules);

        if ($validateData->fails()) {
            return Redirect::route('questionnaires.create')->withErrors($validateData);
        }

        Questionnaire::create($data);
        return Redirect::route('questionnaires.index')->with('success', 'Questionnaire successfully created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Questionnaire $questionnaire)
    {
        $questions = Question::select('questions.*', 'data_types.name')
            ->leftJoin('data_types', 'questions.datatype_id', '=', 'data_types.id')
            ->where('questionnaire_id', $questionnaire->id)
            ->orderBy('questions.position', 'asc')
            ->paginate(self::NUMBER_OF_RECORDS);

        $trashedQuestions = Question::select('questions.*', 'data_types.name')
            ->leftJoin('data_types', 'questions.datatype_id', '=', 'data_types.id')
            ->orderBy('questions.position', 'desc')
            ->where('questionnaire_id', $questionnaire->id)
            ->onlyTrashed()
            ->paginate(self::NUMBER_OF_RECORDS);

        return Inertia::render('Questionnaires/Edit', [
            'questionnaire' => $questionnaire,
            'questions' => $questions,
            'datatypes' => DataType::all(),
            'trashedQuestions' => $trashedQuestions
        ]);
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
        $data = $request->all();

        $validationRules = [
            'label' => 'required|string|max:55',
            'description' => 'required|string|max:250'
        ];

        $validateData = Validator::make($data, $validationRules);

        if ($validateData->fails()) {
            return Redirect::route('questionnaires.edit')->withErrors($validateData);
        }

        $questionnaire = Questionnaire::find($id);
        $questionnaire->update($data);

        return Redirect::route('questionnaires.index')->with('success', 'Questionnaire successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $questionnaire = Questionnaire::find($id);
        $questionnaire->delete();
        return Redirect::route('questionnaires.index')->with('success', 'Questionnaire successfully deleted.');
    }

    /**
     * Restore the specified resource from trash.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $questionnaire = Questionnaire::withTrashed()->find($id);
        $questionnaire->restore();
        return Redirect::route('questionnaires.index')->with('success', 'Questionnaire successfully restored.');
    }

    /**
     * Preview a specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function preview(Questionnaire $questionnaire)
    {
        $questionnaireData = DB::table('questionnaires')
            ->select('questionnaires.id', 'questions.id as questionId', 'questionnaires.label', 'questions.title', 'questions.datatype_id', 'questions.attributes', 'data_types.name')
            ->leftJoin('questions', 'questionnaires.id', '=',  'questions.questionnaire_id')
            ->leftJoin('data_types', 'questions.datatype_id', '=', 'data_types.id')
            ->where('questionnaires.id', '=', $questionnaire->id)
            ->orderByDesc('questions.id')
            ->get();

        return Inertia::render('Questionnaires/Preview', [
            'questionnaireData' =>  $questionnaireData
        ]);
    }

    /**
     * View responses for a specified questionnaire from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function responses(Questionnaire $questionnaire)
    {
        $selectQuery = strval($questionnaire->query);
        $responses = DB::select($selectQuery);

        return Inertia::render('Questionnaires/Responses', [
            'responses' => $responses
        ]);
    }
}
