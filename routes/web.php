<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\CategoriesCampaignController;
use App\Http\Controllers\Admin\EnterController;
use App\Http\Controllers\Admin\OutController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryEventController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\user\IndexController;  
use App\Http\Controllers\user\DonationUserController;  

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

// Home route
Route::get('/', function () {
    return view('auth.login');
});


// Authentication routes
Auth::routes();

// Home dashboard route
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Admin routes for money management
Route::resource('/enter', EnterController::class);
Route::resource('/out', OutController::class);

// Export routes for money management
Route::get('/export/enter', [EnterController::class, 'export'])->name('enter-export');
Route::get('/export/out', [OutController::class, 'export'])->name('out-export');
Route::get('/export/enter-out', [HomeController::class, 'export'])->name('enter-out-export');

// User management routes
Route::resource('/user', UserController::class);

// Event management routes
Route::resource('/categoryEvent', CategoryEventController::class);
Route::resource('/event', EventController::class);

// Campaign categories and campaigns routes
Route::resource('categoriesCampaigns', CategoriesCampaignController::class);
Route::resource('campaigns', CampaignController::class);
Route::get('/campaigns/{campaign}/edit', [CampaignController::class, 'edit'])->name('campaigns.edit');
Route::put('/campaigns/{campaign}', [CampaignController::class, 'update'])->name('campaigns.update');

// Donation routes
Route::get('/donation', [DonationController::class, 'index'])->name('donations.index');
Route::get('donations/create/{campaign}', [DonationController::class, 'create'])->name('donations.create');
Route::post('donations', [DonationController::class, 'store'])->name('donations.store');
Route::post('donations/{donation}/approve', [DonationController::class, 'approve'])->name('donations.approve');

// Optional: Add any additional routes here


//user dashboard
Route::get('/indexs', [IndexController::class, 'index'])->name('indexs');
Route::get('donationuser/create/{campaign}', [DonationUserController::class, 'create'])->name('donationuser.create');
Route::post('donationuser', [DonationUserController::class, 'store'])->name('donationuser.store');