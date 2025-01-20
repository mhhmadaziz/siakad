<?php

use Illuminate\Support\Facades\Route;


Route::group(
    [
        'prefix' => 'guru',
        'as' => 'guru.',
        'middleware' => [
            'auth',
            'verified',
            'role:guru'
        ],
    ],
    function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        Route::resource('modul-pembelajaran', App\Http\Controllers\Guru\ModulPembelajaranController::class);
        Route::resource('kehadiran-siswa', App\Http\Controllers\Guru\KehadiranSiswaController::class);
    }
);
