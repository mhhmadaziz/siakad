<?php

use Illuminate\Support\Facades\Route;


Route::group(
    [
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => [
            'auth',
            'verified',
            'role:admin'
        ],
    ],
    function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');


        Route::get('siswa-template-download', [App\Http\Controllers\Admin\TahunAkademikController::class, 'exportTemplate'])->name('siswa.export-template.download');

        Route::resource('tahun-akademik', App\Http\Controllers\Admin\TahunAkademikController::class);
        Route::prefix('tahun-akademik')->group(
            function () {


                Route::post('{tahun_akademik}/uploadPpdb', [App\Http\Controllers\Admin\TahunAkademikController::class, 'uploadPpdb'])->name('tahun-akademik.upload-ppdb');
                Route::post('{tahun_akademik}/import-data', [App\Http\Controllers\Admin\TahunAkademikController::class, 'importData'])->name('tahun-akademik.import-data');
                Route::get('{tahun_akademik}/ppdb', [App\Http\Controllers\Admin\TahunAkademikController::class, 'ppdb'])->name('tahun-akademik.ppdb');
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
                Route::get('/galeri', [App\Http\Controllers\Admin\CmsController::class, 'galeri'])->name('galeri.index');
                Route::get('/kalender', [App\Http\Controllers\Admin\CmsController::class, 'kalender'])->name('kalender.index');
                Route::get('/ppdb', [App\Http\Controllers\Admin\CmsController::class, 'ppdb'])->name('ppdb.index');
                Route::get('/ppdb/{tahun_akademik}', [App\Http\Controllers\Admin\CmsController::class, 'ppdbShow'])->name('ppdb.show');

                Route::get('/galeri/foto-create', [App\Http\Controllers\Admin\CmsController::class, 'galeriFotoCreate'])->name('galeri.foto-create');
                Route::post('/galeri/foto-store', [App\Http\Controllers\Admin\CmsController::class, 'galeriFotoStore'])->name('galeri.foto-store');
                Route::delete('/galeri/foto-delete/{name}', [App\Http\Controllers\Admin\CmsController::class, 'galeriFotoDelete'])->name('galeri.foto-delete');

                Route::get('/galeri/video-create', [App\Http\Controllers\Admin\CmsController::class, 'galeriVideoCreate'])->name('galeri.video-create');
                Route::post('/galeri/video-store', [App\Http\Controllers\Admin\CmsController::class, 'galeriVideoStore'])->name('galeri.video-store');
                Route::delete('/galeri/video-delete/{name}', [App\Http\Controllers\Admin\CmsController::class, 'galeriVideoDelete'])->name('galeri.video-delete');
            }
        );

        Route::group(
            [
                'prefix' => 'form',
                'as' => 'form.'
            ],
            function () {
                Route::get('/', [App\Http\Controllers\Admin\FormController::class, 'index'])->name('index');
                Route::get('/preview/{tahunAkademik}', [App\Http\Controllers\Admin\FormController::class, 'preview'])->name('preview');
                Route::get('/hasil/{tahunAkademik}', [App\Http\Controllers\Admin\FormController::class, 'hasil'])->name('hasil');
                Route::get('/hasil/{tahunAkademik}/siswa/{jawabanSiswa}', [App\Http\Controllers\Admin\FormController::class, 'hasilSiswa'])->name('hasil.siswa');
            }
        );
    }
);
