<?php

use App\Http\Controllers\API\SampleTrackingController;
use App\Http\Controllers\API\SubjectTrackingController;
use App\Http\Controllers\API\TestController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\SubjectController;
use App\Http\Controllers\API\HotspotsController;
use App\Http\Controllers\API\NewsController;
use App\Http\Controllers\API\RoadNoticesController;
use App\Http\Controllers\API\BlackspotsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Public routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

//Subject registrationg and tracking 
Route::post('/subjects/anon', [SubjectController::class, 'create_anonymously']);
Route::post('/tracking/subject/anon', [SubjectTrackingController::class, 'track_anonymously']);
Route::post('/tracking/subject/batch', [SubjectTrackingController::class, 'store_offline_locations']);
Route::get('/tests/subject/{unique_id}/anon', [TestController::class, 'get_tests']);


Route::get('/blackspots', [BlackspotsController::class, 'index']);
Route::get('/hotspots', [HotspotsController::class, 'index']);
Route::get('/news', [NewsController::class, 'index']);
Route::get('/roadnotices', [RoadNoticesController::class, 'index']);
Route::post('/roadnotices', [RoadNoticesController::class, 'store']);


//get driver movements
Route::get('/movements', [SubjectTrackingController::class, 'get_movements']);


//Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::apiResource('/tests', TestController::class);
    Route::get('/tracking/subject', [SubjectTrackingController::class, 'index']);
    Route::post('/tracking/subject', [SubjectTrackingController::class, 'store']);
    Route::get('/tracking/sample', [SampleTrackingController::class ,'index']);
    Route::post('/tracking/sample', [SampleTrackingController::class ,'store']);
	
	//Subjects
	Route::apiResource('/subjects', SubjectController::class);
});