<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// route for money enter
Route::resource('/enter', \App\Http\Controllers\Admin\EnterController::class);

// route for money out
Route::resource('/out', \App\Http\Controllers\Admin\OutController::class);

// route for export excel
Route::get('/export/enter', [\App\Http\Controllers\Admin\EnterController::class, 'export'])->name('enter-export');

Route::get('/export/out', [\App\Http\Controllers\Admin\OutController::class, 'export'])->name('out-export');

Route::get('/export/enter-out', [HomeController::class, 'export'])->name('enter-out-export');

Route::resource('/user', \App\Http\Controllers\Admin\UserController::class);

Route::resource('/categoryEvent', \App\Http\Controllers\Admin\CategoryEventController::class);

Route::resource('/event', \App\Http\Controllers\Admin\EventController::class);