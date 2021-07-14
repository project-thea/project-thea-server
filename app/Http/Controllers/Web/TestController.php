<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Disease;
use App\Models\Subject;
use App\Models\Test;
use Inertia\Inertia;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    public const NUMBER_OF_RECORDS = 5;

    /**
     * Display a listing of the test resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query_params = $request->all();

        $trashedTests = Test::select('tests.*', 'subjects.first_name', 'subjects.last_name', 'diseases.name', 'subjects.unique_id')
            ->leftJoin('subjects', 'tests.subject_id', '=', 'subjects.id')
            ->leftJoin('diseases', 'tests.disease_id', '=', 'diseases.id')
            ->orderBy('tests.test_date', 'asc')
            ->onlyTrashed()
            ->paginate(self::NUMBER_OF_RECORDS);

        if (isset($query_params['search'])) {
            $tests = Test::select('tests.*', 'subjects.first_name', 'subjects.last_name', 'diseases.name', 'subjects.unique_id')
                ->leftJoin('subjects', 'tests.subject_id', '=', 'subjects.id')
                ->leftJoin('diseases', 'tests.disease_id', '=', 'diseases.id')
                ->orderBy('tests.test_date', 'desc')
                ->where('diseases.name', 'LIKE', '%' . $query_params['search'] . '%')
                ->orWhere('subjects.unique_id', 'LIKE', '%' . $query_params['search'] . '%')
                ->orWhere('tests.status', 'LIKE', '%' . $query_params['search'] . '%')
                ->paginate(self::NUMBER_OF_RECORDS);
        } else {
            $tests = Test::select('tests.*', 'subjects.first_name', 'subjects.last_name', 'diseases.name', 'subjects.unique_id')
                ->leftJoin('subjects', 'tests.subject_id', '=', 'subjects.id')
                ->leftJoin('diseases', 'tests.disease_id', '=', 'diseases.id')
                ->orderBy('tests.test_date', 'desc')
                ->paginate(self::NUMBER_OF_RECORDS);
        }

        return Inertia::render('Tests/Index', [
            'filters' => [
                'search' => isset($query_params['search']) ? $query_params['search'] : ''
            ],
            'tests' => $tests,
            'trashedTests' => $trashedTests,
        ]);
    }

    /**
     * Show the form for creating a new test resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Subject $subject)
    {
        $diseases = Disease::all();
        $subjects = Subject::all();

        return Inertia::render('Tests/Create', [
            'diseases' => $diseases,
            'subject_id' => $subject->id,
            'subjects' => $subjects
        ]);
    }

    /**
     * Store a newly created test resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validationRules = [
            'disease_id' => 'exists:App\Models\Disease,id',
            'subject_id' => 'exists:App\Models\Subject,id',
            'test_date' => 'required|date',
            'status' => 'required|string|max:20'
        ];

        $validateData = Validator::make($data, $validationRules);

        if ($validateData->fails()) {
            return Redirect::route('tests.create')->withErrors($validateData);
        }

        Test::create($data);
        return Redirect::route('tests')->with('success', 'Test successfully added.');
    }

    /**
     * Show the form for editing the specified test resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $test = Test::find($id);
        $diseases = Disease::all();
        $subjects = Subject::all();

        return Inertia::render('Tests/Edit', [
            'test' => $test,
            'diseases' => $diseases,
            'subjects' => $subjects
        ]);
    }

    /**
     * Update the specified test resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validationRules = [
            'disease_id' => 'exists:App\Models\Disease,id',
            'subject_id' => 'exists:App\Models\Subject,id',
            'test_date' => 'required|date',
            'status' => 'required|string|max:20'
        ];

        $validateData = Validator::make($data, $validationRules);

        if ($validateData->fails()) {
            return Redirect::route('tests.edit')->withErrors($validateData);
        }

        $tests = Test::find($id);
        $tests->update($data);

        return Redirect::route('tests')->with('success', 'Test successfully updated.');
    }

    /**
     * Remove the specified test resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $test = Test::find($id);
        $test->delete();
        return Redirect::route('tests')->with('success', 'Test successfully deleted.');
    }

    /**
     * Restore the specified test resource from trash.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $test = Test::withTrashed()->find($id);
        $test->restore();
        return Redirect::route('tests')->with('success', 'Test successfully restored.');
    }
}
