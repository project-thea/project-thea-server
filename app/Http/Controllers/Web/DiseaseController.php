<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Test;
use App\Models\Disease;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DiseaseController extends Controller
{
    /**
     * Get list of diesease for the disease index page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function index(Request $request)
	{
		$query_params = $request->all();
		
		$diseases = [];
		
		if(isset($query_params['search'])){
			$diseases = DB::table('diseases')->where('name', 'LIKE', '%' . $query_params['search'] . '%')
						->get();
		}else{
			$diseases = Disease::all();
		}

		
		
		return Inertia::render('Diseases/Index', [
			'filters' => [
				'search' => isset($query_params['search']) ? $query_params['search'] : ''
			],
			'diseases' => [
				'data' => $diseases
			]
		]);
	}
	
    /**
     * Return disease details for the edit page
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function edit(int $id){
		
		$disease = Disease::find($id);
		
		return Inertia::render('Diseases/Edit', [
			'disease' => $disease
		]);
	}
	
    /**
     * Update disease information details
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function update(Request $request, $id){
		$disease = Disease::find($id);
		
		//@TODO: Add validation
		
		$disease->name = $request->name;
		$disease->description = $request->description;
		
		$disease->save();
		
		return Redirect::back()->with('success', 'Disease updated.');
		
	}
	
    /**
     * Add disease information
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function add(Request $request){
		$data = $request->all();
		
		//@TODO: Add validation
		
		$disease = Disease::create($data);
		
		return Redirect::route('diseases')->with('success', 'Disease added');
	}
	
    /**
     * Trash disease
     *
     * @param  Disease  $disease
     * @return \Illuminate\Http\Response
     */
	public function destroy(Disease $disease){
        $disease->delete();

        return Redirect::back()->with('success', 'Disease deleted.');
	}
	
}