<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Public routes
Route::post('/register', 'API\UserController@register');
Route::post('/login', 'API\UserController@login');

//Protected routes
Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/logout', 'API\UserController@logout');
    Route::apiResource('/tests', 'TestController');
    Route::get('/tracking/subject', 'API\SubjectTrackingController@index');
    Route::get('/tracking/sample', 'API\SampleTrackingController@index');
});


