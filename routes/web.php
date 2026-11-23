<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerjalananController;
use App\Http\Controllers\TitipanController;
use App\Http\Controllers\AdminController;

// 1. Halaman Beranda (Umum)
Route::get('/', fn () => view('home'))->name('home');

// 2 & 3. Autentikasi (Login & Register)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    // 4, 10, 15. Dashboard (Otomatis sesuai role: Pengirim / Traveler / Admin)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 5-9. Fitur Pengirim
    Route::get('/perjalanan', [PerjalananController::class, 'index'])->name('perjalanan.index');
    Route::get('/perjalanan/{perjalanan}/titip', [TitipanController::class, 'create'])->name('titipan.create');
    Route::post('/perjalanan/{perjalanan}/titip', [TitipanController::class, 'store'])->name('titipan.store');
    Route::get('/pelacakan-barang', [TitipanController::class, 'tracking'])->name('titipan.tracking');
    Route::get('/pembayaran', [TitipanController::class, 'payments'])->name('titipan.payments');
    Route::patch('/titipan/{titipan}/bayar', [TitipanController::class, 'pay'])->name('titipan.pay');
    Route::get('/riwayat-titipan', [TitipanController::class, 'index'])->name('titipan.index');

    // 11-14. Fitur Traveler
    Route::get('/perjalanan/buat', [PerjalananController::class, 'create'])->name('perjalanan.create');
    Route::post('/perjalanan', [PerjalananController::class, 'store'])->name('perjalanan.store');
    Route::get('/perjalanan-saya', [PerjalananController::class, 'mine'])->name('perjalanan.mine');
    Route::get('/perjalanan/{perjalanan}/edit', [PerjalananController::class, 'edit'])->name('perjalanan.edit');
    Route::put('/perjalanan/{perjalanan}', [PerjalananController::class, 'update'])->name('perjalanan.update');
    Route::delete('/perjalanan/{perjalanan}', [PerjalananController::class, 'destroy'])->name('perjalanan.destroy');
    Route::get('/titipan-masuk', [TitipanController::class, 'incoming'])->name('titipan.incoming');
    Route::get('/update-pengiriman', [TitipanController::class, 'deliveryUpdates'])->name('titipan.updates');
    Route::patch('/titipan/{titipan}/status', [TitipanController::class, 'updateStatus'])->name('titipan.status');

    // 16-19. Fitur Admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/pengguna', [AdminController::class, 'users'])->name('users');
        Route::patch('/pengguna/{user}/role', [AdminController::class, 'updateUserRole'])->name('users.role');
        Route::get('/perjalanan', [AdminController::class, 'trips'])->name('trips');
        Route::get('/titipan', [AdminController::class, 'shipments'])->name('shipments');
        Route::get('/transaksi', [AdminController::class, 'transactions'])->name('transactions');
    });
});