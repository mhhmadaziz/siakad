<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Services\KehadiranSiswaService;
use Illuminate\Http\Request;

class KehadiranSiswaController extends Controller
{

    public function __construct(protected KehadiranSiswaService $kehadiranSiswaService) {}

    public function index()
    {
        return view('pages.guru.kehadiran-siswa.index');
    }

    public function show($id)
    {
        $mataPelajaran = MataPelajaran::findOrFail($id);

        if ($mataPelajaran->guru->user_id != auth()->id()) {
            return abort(404);
        }

        $kelas = $mataPelajaran->kelas;

        return view('pages.guru.kehadiran-siswa.show', compact('mataPelajaran', 'kelas'));
    }
}
