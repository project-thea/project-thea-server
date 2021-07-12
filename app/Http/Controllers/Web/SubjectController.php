<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Inertia\Inertia;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public const NUMBER_OF_RECORDS = 5;

    /**
     * Display a listing of the subject resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query_params = $request->all();
        $trashedSubjects = Subject::onlyTrashed()->latest()->paginate(self::NUMBER_OF_RECORDS);

        if (isset($query_params['search'])) {
            $subjects = Subject::query()
                ->where('first_name', 'LIKE', '%' . $query_params['search'] . '%')
                ->orWhere('last_name', 'LIKE', '%' . $query_params['search'] . '%')
                ->orWhere('phone', 'LIKE', '%' . $query_params['search'] . '%')
                ->paginate(self::NUMBER_OF_RECORDS);
        } else {
            $subjects = Subject::orderBy('id', 'desc')->paginate(self::NUMBER_OF_RECORDS);
        }

        return Inertia::render('Subjects/Index', [
            'filters' => [
                'search' => isset($query_params['search']) ? $query_params['search'] : ''
            ],
            'subjects' => $subjects,
            'trashedSubjects' => $trashedSubjects
        ]);
    }

    /**
     * Show the form for creating a new subject resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Subjects/Create');
    }

    /**
     * Store a newly created subject resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validationRules = [
            'first_name' => 'required|string|max:55',
            'last_name' => 'required|string|max:55',
            'email' => 'required|email|string',
            'nationality' => 'required|string|max:30',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:20',
            'next_of_kin' => 'required|string|max:55',
            'next_of_kin_phone' => 'required|string|max:20',
            'id_number' => 'required|string|max:55',
            'id_type' => 'required|string|max:55',
        ];

        $validateData = Validator::make($data, $validationRules);

        if ($validateData->fails()) {
            return Redirect::route('subjects.create')->withErrors($validateData);
        }

        Subject::create($data);
        return Redirect::route('subjects')->with('success', 'Subject successfully added.');
    }

    /**
     * Show the form for editing the specified subject resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subject::find($id);

        return Inertia::render('Subjects/Edit', [
            'subject' => $subject
        ]);
    }

    /**
     * Update the specified subject resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validationRules = [
            'first_name' => 'required|string|max:55',
            'last_name' => 'required|string|max:55',
            'email' => 'required|email|string',
            'nationality' => 'required|string|max:30',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:20',
            'next_of_kin' => 'required|string|max:55',
            'next_of_kin_phone' => 'required|string|max:20',
            'id_number' => 'required|string|max:55',
            'id_type' => 'required|string|max:55'
        ];

        $validateData = Validator::make($data, $validationRules);

        if ($validateData->fails()) {
            return Redirect::route('subjects.edit')->withErrors($validateData);
        }

        $subject = Subject::find($id);
        $subject->update($data);

        return Redirect::route('subjects')->with('success', 'Subject successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subject::find($id);
        $subject->delete();
        return Redirect::route('subjects')->with('success', 'Subject successfully deleted.');
    }

    /**
     * Restore the specified subject resource from trash.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $subject = Subject::withTrashed()->find($id);
        $subject->restore();
        return Redirect::route('subjects')->with('success', 'Subject successfully restored.');
    }
}
