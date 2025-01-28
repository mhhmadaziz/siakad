<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\JawabanSiswa;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class FormController extends Controller
{

    public function index()
    {
        return view('pages.guru.form.index');
    }

    public function hasilSiswa(TahunAkademik $tahunAkademik, JawabanSiswa $jawabanSiswa)
    {

        if ($jawabanSiswa->tahun_akademik_id != $tahunAkademik->id) {
            return abort(404);
        }

        return view('pages.admin.form.hasil-siswa', compact('tahunAkademik', 'jawabanSiswa'));
    }
}
