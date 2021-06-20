<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    /**
     * Display a listing of the test resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query_params = $request->all();

		$tests = [];

		if (isset($query_params['search'])) {
			$tests = DB::table('tests')->where(
				'status',
				'LIKE',
				'%' . $query_params['search'] . '%'
			)->get();
		} else {
			$tests = Test::all();
		}

		return Inertia::render('Tests/Index', [
			'filters' => [
				'search' => isset($query_params['search']) ? $query_params['search'] : ''
			],
			'tests' => [
				'data' => $tests
			]
		]);
    }

    /**
     * Show the form for creating a new test resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Tests/Create');
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

        return Inertia::render('Tests/Edit', [
            'test' => $test
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
}
