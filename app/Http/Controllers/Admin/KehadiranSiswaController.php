<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalMataPelajaran;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Services\KehadiranSiswaService;
use Illuminate\Http\Request;

class KehadiranSiswaController extends Controller
{

    public function __construct(protected KehadiranSiswaService $kehadiranSiswaService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('pages.admin.kehadiran-siswa.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Kelas $kelas, MataPelajaran $mataPelajaran)
    {
        // check apakah mata pelajaran ini sudah ada di kelas ini
        if (!$kelas->mataPelajarans->contains($mataPelajaran)) {
            abort(404);
        }

        $forms = $this->kehadiranSiswaService->getFormCreate($mataPelajaran);

        return view('pages.admin.kehadiran-siswa.create', compact('kelas', 'mataPelajaran', 'forms'));
    }

    /**
     * Store a newly created resource in storage.
     */
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
            $kelas = $mataPelajaran->kelas;

            return redirect()->route('admin.kehadiran-siswa.mata-pelajaran.show', [$kelas, $mataPelajaran])->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        return view('pages.admin.kehadiran-siswa.show', compact('kelas'));
    }

    public function showMataPelajaran(Kelas $kelas, MataPelajaran $mataPelajaran)
    {
        // check apakah mata pelajaran ini sudah ada di kelas ini
        if (!$kelas->mataPelajarans->contains($mataPelajaran)) {
            abort(404);
        }

        return view('pages.admin.kehadiran-siswa.mata-pelajaran.index', compact('mataPelajaran', 'kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
