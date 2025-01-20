<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\ModulPembelajaran;
use App\Service\ModulPembelajaranService;
use Illuminate\Http\Request;

class ModulPembelajaranController extends Controller
{

    public function __construct(
        protected ModulPembelajaranService $modulPembelajaranService
    ) {}


    public function index()
    {
        return view('pages.guru.modul-pembelajaran.index');
    }

    public function show(ModulPembelajaran $modulPembelajaran)
    {
        return view('pages.siswa.modul-pembelajaran.show', compact('modulPembelajaran'));
    }

    public function create()
    {
        $forms = $this->modulPembelajaranService->getFormCreate(true);

        return view('pages.guru.modul-pembelajaran.create', compact('forms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar',
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
        ]);

        try {
            $this->modulPembelajaranService->create($validated, $request->file('file'));
            return redirect()->route('guru.modul-pembelajaran.index')->with('success', 'Modul Pembelajaran berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function destroy(ModulPembelajaran $modulPembelajaran)
    {
        try {
            $this->modulPembelajaranService->delete($modulPembelajaran);
            return redirect()->route('guru.modul-pembelajaran.index')->with('success', 'Modul Pembelajaran berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
