<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pertanyaan;
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
}
