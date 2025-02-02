<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Service\MataPelajaranService;
use App\Services\KelasService;
use App\Services\OptionService;
use App\Services\TahunAkademikService;
use Illuminate\Http\Request;

class KelasController extends Controller
{

    public function __construct(
        protected KelasService $kelasService,
        protected OptionService $optionService,
        protected TahunAkademikService $tahunAkademikService,
        protected MataPelajaranService $mataPelajaranService,
    ) {}



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.kelas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tingkatKelas = $this->optionService->getSelectOptionsByCategoryKey('tingkat_kelas');

        $waliKelas = Guru::all()
            ->map(
                function ($item) {
                    return (object) [
                        'value' => $item->id,
                        'label' => $item->user->name,
                    ];
                }
            );

        return view('pages.admin.kelas.create', compact('tingkatKelas', 'waliKelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'tingkat_kelas_id' => 'required',
            'wali_kelas_id' => 'required:exists:guru,id',
        ]);

        $validated['tahun_akademik_id'] = $this->tahunAkademikService->getCurrentTahunAkademik()->id;

        try {
            $this->kelasService->create($validated);
            return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Kelas gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {

        return view('pages.admin.kelas.show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        $waliKelas = Guru::all()
            ->map(
                function ($item) {
                    return (object) [
                        'value' => $item->id,
                        'label' => $item->user->name,
                    ];
                }
            );

        return view('pages.admin.kelas.edit', compact('kelas', 'waliKelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas)
    {

        $validated = $request->validate([
            'name' => 'required',
            'wali_kelas_id' => 'required:exists:guru,id',
        ]);

        try {
            $this->kelasService->update($kelas, $validated);
            return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Kelas gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {

        try {
            $this->kelasService->delete($kelas);
            return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Kelas gagal dihapus');
        }
    }

    public function tambahSiswa(Kelas $kelas)
    {
        return view('pages.admin.kelas.tambah-siswa', compact('kelas'));
    }

    public function tambahMataPelajaran(Kelas $kelas)
    {
        $guru = Guru::all()
            ->map(
                function ($item) {
                    return (object) [
                        'value' => $item->id,
                        'label' => $item->user->name,
                    ];
                }
            );

        return view('pages.admin.kelas.tambah-mata-pelajaran', compact('kelas', 'guru'));
    }

    public function storeMataPelajaran(Request $request, Kelas $kelas)
    {
        $validated = $request->validate([
            'name' => 'required',
            'guru_id' => 'required',
        ]);

        $validated['kelas_id'] = $kelas->id;

        try {
            $this->mataPelajaranService->create($validated);

            return redirect()->route('admin.kelas.show', $kelas->id)->with('success', 'Mata Pelajaran berhasil ditambahkan');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', 'Mata Pelajaran gagal ditambahkan ' . $th->getMessage());
        }
    }
}
