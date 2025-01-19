<?php

use Illuminate\Support\Facades\Route;


Route::group(
    [
        'prefix' => 'siswa',
        'as' => 'siswa.',
        'middleware' => [
            'auth',
            'verified',
            'role:siswa'
        ],
    ],
    function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        Route::get('/jadwal-mata-pelajaran', [App\Http\Controllers\Siswa\JadwalMataPelajaranController::class, 'index'])->name('jadwal-mata-pelajaran.index');
        Route::get('/jadwal-mata-pelajaran/{kelas}', [App\Http\Controllers\Siswa\JadwalMataPelajaranController::class, 'show'])->name('jadwal-mata-pelajaran.show');

        Route::get('/modul-pembelajaran', [App\Http\Controllers\Siswa\ModulPembelajaranController::class, 'index'])->name('modul-pembelajaran.index');
        Route::get('/modul-pembelajaran/{modulPembelajaran}', [App\Http\Controllers\Siswa\ModulPembelajaranController::class, 'show'])->name('modul-pembelajaran.show');

        Route::get('/form', [App\Http\Controllers\Siswa\FormController::class, 'index'])->name('form.index');
        Route::post('/form', [App\Http\Controllers\Siswa\FormController::class, 'submit'])->name('form.submit');
        Route::get('/form/result', [App\Http\Controllers\Siswa\FormController::class, 'show'])->name('form.show');
    }
);
