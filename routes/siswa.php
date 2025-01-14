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
    }
);
