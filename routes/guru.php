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
        Route::resource('kehadiran-siswa', App\Http\Controllers\Guru\KehadiranSiswaController::class)->except(['create', 'store']);
        Route::get('kehadiran-siswa/{mataPelajaran}/create', [App\Http\Controllers\Guru\KehadiranSiswaController::class, 'create'])->name('kehadiran-siswa.create');
        Route::post('kehadiran-siswa', [App\Http\Controllers\Guru\KehadiranSiswaController::class, 'store'])->name('kehadiran-siswa.store');
    }
);
