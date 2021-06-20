<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\TrackingController;
use App\Http\Controllers\Web\AnalysisController;
use App\Http\Controllers\Web\DiseaseController;
use App\Http\Controllers\Web\SubjectController;
use App\Http\Controllers\Web\TestController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
		'canResetPassword' => Route::has('password.request'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])
	->get('/dashboard', [DashboardController::class, 'index'])
	->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])
	->get('/tests', [TestController::class, 'index'])
	->name('tests');

Route::middleware(['auth:sanctum', 'verified'])
	->get('/subjects', [SubjectController::class, 'index'])
	->name('subjects');

//Route::middleware(['auth:sanctum', 'verified'])
//	->get('/diseases', [DiseaseController::class, 'index'])
//	->name('diseases');
//
//Route::middleware(['auth:sanctum', 'verified'])
//	->get('/diseases/edit/{id}', [DiseaseController::class, 'edit'])
//	->name('diseases.edit	');
	
	
Route::middleware(['auth:sanctum', 'verified'])
	->get('/tracking', [TrackingController::class, 'index'])
	->name('tracking');

Route::middleware(['auth:sanctum', 'verified'])
	->get('/analysis', [AnalysisController::class, 'index'])
	->name('analysis');
	
	
Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/diseases', [DiseaseController::class, 'index'])->name('diseases');
    Route::get('/diseases/edit/{id}', [DiseaseController::class, 'edit'])->name('diseases.edit');
	Route::post('/diseases/update/{id}', [DiseaseController::class, 'update'])->name('diseases.update');
	Route::post('/diseases/add', [DiseaseController::class, 'add'])->name('diseases.add');
	Route::get('/diseases/new', function(){
		return Inertia::render('Diseases/Add');
	})->name('diseases.new');
	Route::delete('diseases/trash/{disease}', [DiseaseController::class, 'destroy'])->name('diseases.destroy');

});
