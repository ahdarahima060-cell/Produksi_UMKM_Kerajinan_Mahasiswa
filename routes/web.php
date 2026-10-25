
<?php

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Login dan registrasi
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


// Dashboard dan pengelolaan admin
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::view('/dashboard', 'admin.dashboard')
            ->name('dashboard');

        // CRUD Produk
        Route::resource(
            'produk',
            \App\Http\Controllers\Admin\ProdukController::class
        );
        // CRUD Produksi
        Route::resource(
            'produksi',
            \App\Http\Controllers\Admin\ProduksiController::class
        );
    });


// Dashboard user
Route::prefix('user')
    ->name('user.')
    ->middleware(['auth', 'role:user'])
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');
    });
    
Route::get('/produk/{produk}', [DashboardController::class, 'showProduk'])
    ->name('produk.show');