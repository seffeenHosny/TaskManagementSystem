<?php

use App\Http\Controllers\Dashboard\TaskController;
use App\Http\Controllers\Dashboard\UserController;
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
    return redirect('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => [ 'auth']], function () {
    Route::resource('users', UserController::class)->except('show');
    Route::resource('tasks', TaskController::class)->except('show');
    Route::get('tasks/{task}/start', [TaskController::class , 'start'])->name('tasks.start');
    Route::get('tasks/{task}/complete', [TaskController::class , 'complete'])->name('tasks.complete');
});
