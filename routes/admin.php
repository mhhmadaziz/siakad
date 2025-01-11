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

                Route::get('{tahun_akademik}/kalender-akademik', [App\Http\Controllers\Admin\TahunAkademikController::class, 'showKalenderAkademik'])->name('tahun-akademik.kalender-akademik');


                Route::get('{tahun_akademik}/kelas', [App\Http\Controllers\Admin\TahunAkademikController::class, 'kelas'])->name('tahun-akademik.kelas');

                Route::get('{tahun_akademik}/kelas/create', [App\Http\Controllers\Admin\TahunAkademikController::class, 'createKelas'])->name('tahun-akademik.kelas.create');

                Route::post('{tahun_akademik}/kelas', [App\Http\Controllers\Admin\TahunAkademikController::class, 'storeKelas'])->name('tahun-akademik.kelas.store');

                Route::get('{tahun_akademik}/kelas/{kelas}/jadwal', [App\Http\Controllers\Admin\TahunAkademikController::class, 'jadwalMataPelajaran'])->name('tahun-akademik.kelas.jadwal');
            }
        );

        Route::resource('guru', App\Http\Controllers\Admin\GuruController::class);
        Route::resource('siswa', App\Http\Controllers\Admin\SiswaController::class);
        Route::resource('jadwal-mata-pelajaran', App\Http\Controllers\Admin\JadwalMataPelajaranController::class);
        Route::resource('modul-pembelajaran', App\Http\Controllers\Admin\ModulPembelajaranController::class);
        Route::resource('mata-pelajaran', App\Http\Controllers\Admin\MataPelajaranController::class);


        Route::get('kelas/{kelas}/tambah-siswa', [App\Http\Controllers\Admin\KelasController::class, 'tambahSiswa'])->name('kelas.siswa.create');
        Route::get('kelas/{kelas}/tambah-mata-pelajaran', [App\Http\Controllers\Admin\KelasController::class, 'tambahMataPelajaran'])->name('kelas.mata-pelajaran.create');
        Route::post('kelas/{kelas}/tambah-mata-pelaajaran', [App\Http\Controllers\Admin\KelasController::class, 'storeMataPelajaran'])->name('kelas.mata-pelajaran.store');
        Route::resource('kelas', App\Http\Controllers\Admin\KelasController::class)->parameter('kelas', 'kelas');

        Route::resource('kehadiran-siswa', App\Http\Controllers\Admin\KehadiranSiswaController::class)->except(['show', 'create']);
        Route::get('kehadiran-siswa/{kelas}', [App\Http\Controllers\Admin\KehadiranSiswaController::class, 'show'])->name('kehadiran-siswa.show');
        Route::get('kehadiran-siswa/{kelas}/mata-pelajaran/{mataPelajaran}', [App\Http\Controllers\Admin\KehadiranSiswaController::class, 'showMataPelajaran'])->name('kehadiran-siswa.mata-pelajaran.show');
        Route::get('kehadiran-siswa/{kelas}/mata-pelajaran/{mataPelajaran}/create', [App\Http\Controllers\Admin\KehadiranSiswaController::class, 'create'])->name('kehadiran-siswa.create');

        Route::group(
            [
                'prefix' => 'cms',
                'as' => 'cms.'
            ],
            function () {
                Route::get('/', [App\Http\Controllers\Admin\CmsController::class, 'index'])->name('index');
                Route::get('/home', [App\Http\Controllers\Admin\CmsController::class, 'home'])->name('home.index');
                Route::get('/galeri', [App\Http\Controllers\Admin\CmsController::class, 'index'])->name('galeri.index');
                Route::get('/kalender', [App\Http\Controllers\Admin\CmsController::class, 'index'])->name('kalender.index');
                Route::get('/ppdb', [App\Http\Controllers\Admin\CmsController::class, 'index'])->name('ppdb.index');
            }
        );
    }
);
