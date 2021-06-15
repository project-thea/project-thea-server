<?php

use App\Http\Controllers\API\SampleTrackingController;
use App\Http\Controllers\API\SubjectTrackingController;
use App\Http\Controllers\API\TestController;
use App\Http\Controllers\API\UserController;
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

//Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::apiResource('/tests', TestController::class);
    Route::get('/tracking/subject', [SubjectTrackingController::class, 'index']);
    Route::post('/tracking/subject', [SubjectTrackingController::class, 'store']);
    Route::get('/tracking/sample', [SampleTrackingController::class ,'index']);
    Route::post('/tracking/sample', [SampleTrackingController::class ,'store']);
});