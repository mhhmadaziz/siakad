<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModulPembelajaran;
use App\Service\ModulPembelajaranService;
use Illuminate\Http\Request;

class ModulPembelajaranController extends Controller
{

    public function __construct(protected ModulPembelajaranService $modulPembelajaranService) {}


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.modul-pembelajaran.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $forms = $this->modulPembelajaranService->getFormCreate();
        return view('pages.admin.modul-pembelajaran.create', compact('forms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar',
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
        ]);

        try {
            $this->modulPembelajaranService->create($validated, $request->file('file'));
            return redirect()->route('admin.modul-pembelajaran.index')->with('success', 'Modul Pembelajaran berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ModulPembelajaran $modulPembelajaran)
    {
        return view('pages.admin.modul-pembelajaran.show', compact('modulPembelajaran'));
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
