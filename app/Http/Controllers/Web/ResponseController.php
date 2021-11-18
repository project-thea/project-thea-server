<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Questionnaire;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Questionnaire $questionnaire, Request $request)
    {
        $this->authorize('isAdmin');
        
        $validationRules = [
            'questionnaire_id' => 'exists:App\Models\Questionnaire,id',
            'data' => 'json'
        ];

        $validateData = $request->validate($validationRules);

        if (!$validateData) {
            return Redirect::route('questionnaires.preview', ['questionnaire' => $questionnaire])->with('fail', 'There was a validation error.');
        }

        $validateData['created_by'] = Auth::id();
        $validateData['updated_by'] = Auth::id();
        $validateData['questionnaire_id'] = $questionnaire->id;

        Response::create($validateData);
        return Redirect::route('questionnaires.index')->with('success', 'Questions preview responses have been successfully created.');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
