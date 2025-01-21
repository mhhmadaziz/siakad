<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\JadwalMataPelajaran;
use App\Models\MataPelajaran;
use App\Services\KehadiranSiswaService;
use Illuminate\Http\Request;

class KehadiranSiswaController extends Controller
{

    public function __construct(protected KehadiranSiswaService $kehadiranSiswaService) {}

    private function checkMataPelajaran(MataPelajaran $mataPelajaran)
    {
        if ($mataPelajaran->guru->user_id != auth()->id()) {
            return abort(404);
        }
    }

    public function index()
    {
        return view('pages.guru.kehadiran-siswa.index');
    }

    public function show($id)
    {
        $mataPelajaran = MataPelajaran::findOrFail($id);

        $this->checkMataPelajaran($mataPelajaran);


        $kelas = $mataPelajaran->kelas;

        return view('pages.guru.kehadiran-siswa.show', compact('mataPelajaran', 'kelas'));
    }

    public function create(MataPelajaran $mataPelajaran)
    {
        $this->checkMataPelajaran($mataPelajaran);
        $kelas = $mataPelajaran->kelas;
        $forms = $this->kehadiranSiswaService->getFormCreate($mataPelajaran);

        return view('pages.guru.kehadiran-siswa.create', compact('mataPelajaran', 'kelas', 'forms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jadwal_mata_pelajaran_id' => 'required|exists:jadwal_mata_pelajaran,id',
            'tanggal' => 'required|date',
        ]);

        try {
            $this->kehadiranSiswaService->validateHari($validated);
            $this->kehadiranSiswaService->create($validated);

            $jadwal = JadwalMataPelajaran::find($validated['jadwal_mata_pelajaran_id']);
            $mataPelajaran = $jadwal->mataPelajaran;

            return redirect()->route('guru.kehadiran-siswa.show', $mataPelajaran->id)->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
}
