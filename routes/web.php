<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TimController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\VerifyController;
use Illuminate\Support\Facades\Route;

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
    return redirect(route('project.index'));
});

Route::resource('project', ProjectController::class);
Route::resource('tugas', TugasController::class);
Route::resource('tim', TimController::class);

Route::get('/verify', [VerifyController::class, 'verify'])->name('verify');
