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
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\user\IndexController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\user\DonationUserController;
use App\Http\Controllers\DonorController;

// Route::get('/', function () {
//     if (Auth::check()) {
//         if (Auth::user()->role == 1) {
//             return redirect('/home');
//         } elseif (Auth::user()->role == 2) {
//             return redirect('/indexs');
//         }
//     }
//     return redirect('/login');
// })->name('root');

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::resource('/user', UserController::class);

Route::get('/forgot-password', [LoginController::class, 'forgotPassword'])->name('forgot-password');
Route::post('/forgot-password-act', [LoginController::class, 'forgot_password_act'])->name('forgot-password-act');

Route::get('/validasi-forgot-password/{token}', [LoginController::class, 'validasi_forgot_password'])->name('validasi-forgot-password');
Route::post('/validasi-forgot-password-act', [LoginController::class, 'validasi_forgot_password_act'])->name('validasi-forgot-password-act');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Admin routes
Route::group(['middleware' => ['auth', 'role:1']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('admin.home');
    Route::resource('/enter', EnterController::class);
    Route::resource('/out', OutController::class);
    Route::get('/export/enter', [EnterController::class, 'export'])->name('enter-export');
    Route::get('/export/out', [OutController::class, 'export'])->name('out-export');
    Route::get('/export/enter-out', [HomeController::class, 'export'])->name('enter-out-export');
    Route::resource('/user', UserController::class);
    Route::resource('/categoryEvent', CategoryEventController::class);
    Route::resource('/event', EventController::class);
    Route::resource('categoriesCampaigns', CategoriesCampaignController::class);
    Route::resource('campaigns', CampaignController::class);
    Route::get('/campaigns/{campaign}/edit', [CampaignController::class, 'edit'])->name('campaigns.edit');
    Route::put('/campaigns/{campaign}', [CampaignController::class, 'update'])->name('campaigns.update');
    Route::get('/donation', [DonationController::class, 'index'])->name('donations.index');
    Route::get('donations/create/{campaign}', [DonationController::class, 'create'])->name('donations.create');
    Route::post('donations', [DonationController::class, 'store'])->name('donations.store');
    Route::post('donations/{donation}/approve', [DonationController::class, 'approve'])->name('donations.approve');
    Route::put('/donations/{donation}/reject', [DonationController::class, 'reject'])->name('donations.reject');

    Route::get('/donors', [DonorController::class, 'index'])->name('donors.index');

});

// User routes
Route::group(['middleware' => ['auth', 'role:2']], function () {
    Route::get('/indexs', [IndexController::class, 'index'])->name('user.indexs');
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
    Route::get('donationuser/create/{campaign}', [DonationUserController::class, 'create'])->name('donationuser.create');
    Route::post('donationuser', [DonationUserController::class, 'store'])->name('donationuser.store');
});


// user guest
Route::group([
    'middleware' => ['auth', 'guest'],
], function () {
    
});

Auth::routes();
