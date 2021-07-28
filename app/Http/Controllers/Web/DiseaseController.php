<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Disease;
use Inertia\Inertia;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class DiseaseController extends Controller
{
    public const NUMBER_OF_RECORDS = 5;

    /**
     * Display a listing of the disease resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query_params = $request->all();
        $trashedDiseases = Disease::onlyTrashed()->latest()->paginate(self::NUMBER_OF_RECORDS);

        if (isset($query_params['search'])) {
            $diseases = Disease::query()
                ->where('name', 'LIKE', '%' . $query_params['search'] . '%')
                ->paginate(self::NUMBER_OF_RECORDS);
        } else {
            $diseases = Disease::orderBy('id', 'desc')->paginate(self::NUMBER_OF_RECORDS);
        }

        return Inertia::render('Diseases/Index', [
            'filters' => [
                'search' => isset($query_params['search']) ? $query_params['search'] : ''
            ],
            'diseases' => $diseases,
            'trashedDiseases' => $trashedDiseases
        ]);
    }

    /**
     * Show the form for creating a new disease resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('isAdmin');
        return Inertia::render('Diseases/Create');
    }

    /**
     * Store a newly created disease resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('isAdmin');

        $data = $request->all();

        $validationRules = [
            'name' => 'required|string|max:55',
            'description' => 'required|string|max:250',
        ];

        $validateData = Validator::make($data, $validationRules);

        if ($validateData->fails()) {
            return Redirect::route('diseases.create')->withErrors($validateData);
        }

        Disease::create($data);
        return Redirect::route('diseases.index')->with('success', 'Disease successfully added.');
    }

    /**
     * Show the form for editing the specified disease resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('isAdmin');

        $disease = Disease::find($id);

        return Inertia::render('Diseases/Edit', [
            'disease' => $disease
        ]);
    }

    /**
     * Update the specified disease resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('isAdmin');

        $data = $request->all();

        $validationRules = [
            'name' => 'required|string|max:55',
            'description' => 'required|string|max:250'
        ];

        $validateData = Validator::make($data, $validationRules);

        if ($validateData->fails()) {
            return Redirect::route('diseases.edit')->withErrors($validateData);
        }

        $disease = Disease::find($id);
        $disease->update($data);

        return Redirect::route('diseases.index')->with('success', 'Disease successfully updated.');
    }

    /**
     * Remove the specified disease resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $disease = Disease::find($id);
        $disease->delete();
        return Redirect::route('diseases.index')->with('success', 'Disease successfully deleted.');
    }

    /**
     * Restore the specified disease resource from trash.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $this->authorize('isAdmin');

        $disease = Disease::withTrashed()->find($id);
        $disease->restore();
        return Redirect::route('diseases.index')->with('success', 'Disease successfully restored.');
    }
}
