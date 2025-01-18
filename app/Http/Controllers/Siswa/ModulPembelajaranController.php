<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\ModulPembelajaran;
use Illuminate\Http\Request;

class ModulPembelajaranController extends Controller
{

    public function index()
    {
        return view('pages.siswa.modul-pembelajaran.index');
    }

    public function show(ModulPembelajaran $modulPembelajaran)
    {
        return view('pages.siswa.modul-pembelajaran.show', compact('modulPembelajaran'));
    }
}
