<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JawabanSiswa;
use App\Models\Pertanyaan;
use App\Models\Siswa;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class FormController extends Controller
{

    public function index()
    {
        return view('pages.admin.form.index');
    }

    public function preview(TahunAkademik $tahunAkademik)
    {
        $pertanyaans = Pertanyaan::selectedTahunAkademik($tahunAkademik->id)->get();

        return view('pages.admin.form.preview', compact('pertanyaans'));
    }

    public function hasil(TahunAkademik $tahunAkademik)
    {

        return view('pages.admin.form.hasil', compact('tahunAkademik'));
    }

    public function hasilSiswa(TahunAkademik $tahunAkademik, JawabanSiswa $jawabanSiswa)
    {

        if ($jawabanSiswa->tahun_akademik_id != $tahunAkademik->id) {
            return abort(404);
        }

        return view('pages.admin.form.hasil-siswa', compact('tahunAkademik', 'jawabanSiswa'));
    }
}
