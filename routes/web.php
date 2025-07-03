<?php

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/run-migrate', function () {
    Artisan::call('migrate', ['--force' => true]);
    return 'Migrasi selesai.';
});

// Route bawaan Breeze (login/register/logout)
require __DIR__.'/auth.php';
