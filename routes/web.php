<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
Route::get('/galeri', [App\Http\Controllers\HomeController::class, 'galeri'])->name('home.galeri');
Route::get('/galeri/video', [App\Http\Controllers\HomeController::class, 'video'])->name('home.galeri.video');
Route::get('/kalender', [App\Http\Controllers\HomeController::class, 'kalender'])->name('home.kalender');
Route::get('/ppdb', [App\Http\Controllers\HomeController::class, 'ppdb'])->name('home.ppdb');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', App\Http\Controllers\DashboardController::class)->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/pdf/{path}', [App\Http\Controllers\PdfController::class, 'download'])
        ->where('path', '.*')
        ->name('pdf.download');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
