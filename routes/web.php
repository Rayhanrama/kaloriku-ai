<?php

use App\Http\Controllers\AIController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/run-migrate', function () {
    Artisan::call('migrate', ['--force' => true]);
    return 'Migrasi selesai.';
});

// Halaman publik (bisa diakses siapa saja)
Route::get('/', function () {
    return view('home');
});

// Dashboard (hanya untuk user login & verified)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Grup route untuk user yang sudah login
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Makanan CRUD
    Route::resource('makanan', MakananController::class);

    // Aktivitas CRUD
    Route::resource('aktivitas', AktivitasController::class);

    // (Opsional) Rencana AI, laporan, dll
    Route::get('/saran-ai', [DashboardController::class, 'saranAi'])->name('saran.ai');
    Route::get('/ai', [AIController::class, 'index'])->middleware('auth')->name('ai.index');
});

// Route bawaan Breeze (login/register/logout)
require __DIR__.'/auth.php';
