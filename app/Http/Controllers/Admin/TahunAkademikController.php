<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\TahunAkademik;
use App\Services\OptionService;
use App\Services\TahunAkademikService;
use Illuminate\Http\Request;

class TahunAkademikController extends Controller
{

    public function __construct(
        protected TahunAkademikService $tahunAkademikService,
        protected OptionService $optionService
    ) {}


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahunAkademik = $this->tahunAkademikService->getAllTahunAkademik();

        return view('pages.admin.tahun-akademik.index', compact('tahunAkademik'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('pages.admin.tahun-akademik.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'mulai' => 'required|date',
            'selesai' => 'required|date|after:mulai',
        ]);

        try {

            $this->tahunAkademikService->create($validated);

            return redirect()->route('admin.tahun-akademik.index')->with('success', 'Tahun Akademik berhasil ditambahkan');
        } catch (\Throwable $th) {

            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TahunAkademik $tahunAkademik)
    {
        return view('pages.admin.tahun-akademik.show', compact('tahunAkademik'));
    }

    public function kelas(TahunAkademik $tahunAkademik)
    {
        return view('pages.admin.tahun-akademik.kelas.index', compact('tahunAkademik'));
    }

    public function createKelas(TahunAkademik $tahunAkademik)
    {
        $tingkatKelas = $this->optionService->getSelectOptionsByCategoryKey('tingkat_kelas');
        return view('pages.admin.tahun-akademik.kelas.create', compact('tahunAkademik', 'tingkatKelas'));
    }

    public function storeKelas(Request $request, TahunAkademik $tahunAkademik)
    {
        $validated = $request->validate([
            'name' => 'required',
            'tingkat_kelas_id' => 'required',
        ]);

        try {
            $this->tahunAkademikService->createKelas($tahunAkademik, $validated);

            return redirect()->route('admin.tahun-akademik.kelas', $tahunAkademik)->with('success', 'Kelas berhasil ditambahkan');
        } catch (\Throwable $th) {

            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }


    public function jadwalMataPelajaran(TahunAkademik $tahunAkademik, Kelas $kelas)
    {
        return view('pages.admin.tahun-akademik.kelas.jadwal', compact('tahunAkademik', 'kelas'));
    }

    public function showKalenderAkademik(TahunAkademik $tahunAkademik)
    {
        return view('pages.admin.tahun-akademik.kalender-akademik.show', compact('tahunAkademik'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TahunAkademik $tahunAkademik)
    {
        return view('pages.admin.tahun-akademik.edit', compact('tahunAkademik'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TahunAkademik $tahunAkademik)
    {

        $validated = $request->validate([
            'name' => 'required',
            'mulai' => 'required|date',
            'selesai' => 'required|date|after:mulai',
        ]);

        try {
            $this->tahunAkademikService->update($tahunAkademik, $validated);

            return redirect()->route('admin.tahun-akademik.show', $tahunAkademik->id)->with('success', 'Tahun Akademik berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function uploadPpdb(Request $request, TahunAkademik $tahunAkademik)
    {
        $validated = $request->validate([
            'file' => 'required|file|mimes:pdf|max:2048'
        ]);

        try {
            $this->tahunAkademikService->uploadPpdb($tahunAkademik, $validated['file']);

            return redirect()->back()->with('success', 'File PPDB berhasil diunggah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function ppdb(TahunAkademik $tahunAkademik)
    {
        return view('pages.admin.cms.ppdb.show', compact('tahunAkademik'));
    }

    public function importData(Request $request, TahunAkademik $tahunAkademik)
    {
        $validated = $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:2048'
        ]);

        try {
            $this->tahunAkademikService->importData($tahunAkademik, $validated['file']);

            return redirect()->back()->with('success', 'Data berhasil diunggah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
