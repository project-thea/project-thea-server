<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/subjects', function () {
    return Inertia::render('Subjects');
})->name('subjects');

Route::middleware(['auth:sanctum', 'verified'])->get('/tests', function () {
    return Inertia::render('Tests');
})->name('tests');

Route::middleware(['auth:sanctum', 'verified'])->get('/diseases', function () {
    return Inertia::render('Diseases');
})->name('diseases');

// Route::group(['middleware' => ['auth:sanctum', 'verified']], function(){
//     Route::get('/tests', [TestsController::class, 'index'])->name('tests');
// });