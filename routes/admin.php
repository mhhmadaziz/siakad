<?php

use Illuminate\Support\Facades\Route;


Route::group(
    [
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => [
            'auth',
            'role:admin'
        ],
    ],
    function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        Route::resource('tahun-akademik', App\Http\Controllers\Admin\TahunAkademikController::class);
        Route::prefix('tahun-akademik')->group(
            function () {
                Route::get('{tahun_akademik}/kelas', [App\Http\Controllers\Admin\TahunAkademikController::class, 'kelas'])->name('tahun-akademik.kelas');
            }
        );

        Route::resource('guru', App\Http\Controllers\Admin\GuruController::class);
        Route::resource('siswa', App\Http\Controllers\Admin\SiswaController::class);
        Route::resource('jadwal-mata-pelajaran', App\Http\Controllers\Admin\JadwalMataPelajaranController::class);
        Route::resource('modul-pembelajaran', App\Http\Controllers\Admin\ModulPembelajaranController::class);
        Route::resource('kelas', App\Http\Controllers\Admin\KelasController::class)->parameter('kelas', 'kelas');
    }
);
