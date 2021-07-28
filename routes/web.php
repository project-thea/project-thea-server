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
use App\Http\Controllers\Web\UserController;

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

Route::group(['middleware' => ['auth:sanctum', 'verified', 'throttle:web']], function () {
	// Analysis
	Route::get('/analysis', [AnalysisController::class, 'index'])->name('analysis');

	// Tracking
 	Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking');

	// Dashboard
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

	//	Subjects
	Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
	Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
	Route::post('/subjects', [SubjectController::class, 'store'])->name('subjects.store');
	Route::get('/subjects/{subject}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
	Route::patch('/subjects/{subject}', [SubjectController::class, 'update'])->name('subjects.update');
	Route::delete('/subjects/{subject}/trash', [SubjectController::class, 'destroy'])->name('subjects.destroy');
	Route::put('/subjects/{subject}/restore', [SubjectController::class, 'restore'])->name('subjects.restore');

	// Diseases
	Route::get('/diseases', [DiseaseController::class, 'index'])->name('diseases.index');
	Route::get('/diseases/create', [DiseaseController::class, 'create'])->name('diseases.create');
	Route::post('/diseases', [DiseaseController::class, 'store'])->name('diseases.store');
	Route::get('/diseases/{disease}/edit', [DiseaseController::class, 'edit'])->name('diseases.edit');
	Route::patch('/diseases/{disease}', [DiseaseController::class, 'update'])->name('diseases.update');
	Route::delete('/diseases/{disease}/trash', [DiseaseController::class, 'destroy'])->name('diseases.destroy');
	Route::put('/diseases/{disease}/restore', [DiseaseController::class, 'restore'])->name('diseases.restore');

	// Tests
	Route::get('/tests', [TestController::class, 'index'])->name('tests.index');
	Route::get('/tests/{subject}/create', [TestController::class, 'create'])->name('tests.create');
	Route::post('/tests', [TestController::class, 'store'])->name('tests.store');
	Route::get('/tests/{test}/edit', [TestController::class, 'edit'])->name('tests.edit');
	Route::patch('/tests/{test}', [TestController::class, 'update'])->name('tests.update');
	Route::delete('/tests/{test}/trash', [TestController::class, 'destroy'])->name('tests.destroy');
	Route::put('/tests/{test}/restore', [TestController::class, 'restore'])->name('tests.restore');

	//Manage users
	Route::get('/users', [UserController::class, 'index'])->name('users.index');
	Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
	Route::post('/users', [UserController::class, 'store'])->name('users.store');
	Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
	Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
	Route::delete('/users/{user}/trash', [UserController::class, 'destroy'])->name('users.destroy');
	Route::put('/users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');

});
