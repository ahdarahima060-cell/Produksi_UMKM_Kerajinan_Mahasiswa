<?php

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\CheckoutController;
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
        Route::resource('produk', \App\Http\Controllers\Admin\ProdukController::class);
        
        // CRUD Produksi
        Route::resource('produksi', \App\Http\Controllers\Admin\ProduksiController::class);

        // Proses Pesanan
        Route::get('/pesanan', [\App\Http\Controllers\Admin\PesananController::class, 'index'])->name('pesanan.index');
        Route::get('/pesanan/{id}', [\App\Http\Controllers\Admin\PesananController::class, 'show'])->name('pesanan.show');
    });

// Dashboard user & Keranjang & Checkout
Route::prefix('user')
    ->name('user.')
    ->middleware(['auth', 'role:user'])
    ->group(function () {
        
        // Dashboard User
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Keranjang Belanja
        Route::get('/keranjang', [\App\Http\Controllers\User\KeranjangController::class, 'index'])
            ->name('keranjang.index');

        Route::post('/keranjang', [\App\Http\Controllers\User\KeranjangController::class, 'store'])
            ->name('keranjang.store');
        
        // Hapus item dari keranjang
        Route::delete('/keranjang/{id}', [\App\Http\Controllers\User\KeranjangController::class, 'destroy'])
            ->name('keranjang.destroy');

        // Checkout
        Route::get('/checkout', [\App\Http\Controllers\User\CheckoutController::class, 'index'])
            ->name('checkout.index');

        Route::post('/checkout', [\App\Http\Controllers\User\CheckoutController::class, 'simpan_pesanan'])
            ->name('checkout.store');
            
        // TAMBAHAN BARU: Halaman Pesanan Berhasil
        Route::get('/checkout/sukses/{id}', [\App\Http\Controllers\User\CheckoutController::class, 'sukses'])
            ->name('checkout.sukses');
        
        // Halaman pembayaran Midtrans (jika masih diperlukan)
        Route::get('/pembayaran/{order}', [\App\Http\Controllers\User\CheckoutController::class, 'halamanPembayaran'])
            ->name('pembayaran');

    });

// Detail Produk (Bebas diakses)
Route::get('/produk/{produk}', [DashboardController::class, 'showProduk'])
    ->name('produk.show');

// Webhook Midtrans (di luar grup auth agar bisa diakses server Midtrans)
Route::post('/midtrans/webhook', [\App\Http\Controllers\User\CheckoutController::class, 'handleWebhook']);