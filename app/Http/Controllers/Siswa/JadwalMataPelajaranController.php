<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class JadwalMataPelajaranController extends Controller
{
    public function index()
    {
        return view('pages.siswa.jadwal-mata-pelajaran.index');
    }

    public function show(Kelas $kelas)
    {
        return view('pages.siswa.jadwal-mata-pelajaran.show', compact('kelas'));
    }
}
