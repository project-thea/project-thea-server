<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class SubjectController extends Controller
{
    public const NUMBER_OF_RECORDS = 10;

    /**
     * Display a listing of the Subject resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,email']
        ]);

        $query = Subject::query();

        if (request('search')) {
            $query->where('name', 'LIKE', '%' . request('search') . '%');
        }

        if (request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }

        return Inertia::render('Subjects', [
            'subjects' => $query->paginate(self::NUMBER_OF_RECORDS)->withQueryString(),
            'filters' => request()->all(['search', 'field', 'direction'])
        ]);
    }

    /**
     * Show the form for creating a new Subject resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created Subject resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validateData = [
            'name' => 'required|string|max:55',
            'email' => 'required|string|email:rfc,dns',
            'nationality' => 'required|string|max:55',
            'date_of_birth' => 'date_format:Y-m-d',
            'phone' => 'required|string|max:20',
            'next_of_kin' => 'required|string|max:55',
            'next_of_kin_phone' => 'required|string|max:20',
            'id_number' => 'string|max:55',
            'id_type' => 'string|max:55',
        ];

        Validator::make($data, $validateData)->validate();

        Subject::create($data);

        return redirect()->back()->with('message', 'Subject created successfully.');
    }

    /**
     * Display the specified Subject resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified Subject resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified Subject resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();

        $validateData = [
            'name' => 'required|string|max:55',
            'email' => 'required|string|email:rfc,dns',
            'nationality' => 'required|string|max:55',
            'date_of_birth' => 'date_format:Y-m-d',
            'phone' => 'required|string|max:20',
            'next_of_kin' => 'required|string|max:55',
            'next_of_kin_phone' => 'required|string|max:20',
            'id_number' => 'string|max:55',
            'id_type' => 'string|max:55',
        ];

        Validator::make($data, $validateData)->validate();

        if ($request->has('id')) {
            Subject::find($request->input('id'))->update($data);
            return redirect()->back()->with('message', 'Subject updated successfully.');
        }
    }

    /**
     * Remove the specified Subject resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            Subject::find($request->input('id'))->delete();
            return redirect()->back()->with('message', 'Subject deleted successfully.');
        }
    }
}
