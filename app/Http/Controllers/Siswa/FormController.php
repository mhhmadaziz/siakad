<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiswaFormRequest;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class FormController extends Controller
{

    public function index()
    {
        $pertanyaans = Pertanyaan::currentTahunAkademik()->get();
        return view('pages.siswa.form.index', compact('pertanyaans'));
    }

    public function submit(SiswaFormRequest $request)
    {
        dd($request->validated());
    }
}
