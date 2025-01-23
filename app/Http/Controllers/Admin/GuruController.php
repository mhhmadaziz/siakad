<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use App\Services\GuruService;
use App\Services\OptionService;
use Illuminate\Http\Request;

class GuruController extends Controller
{

    public function __construct(
        protected GuruService $guruService,
        protected OptionService $optionService

    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jumlahGuru = $this->guruService->getJumlahGuru();
        return view('pages.admin.guru.index', compact('jumlahGuru'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $forms = $this->guruService->getFormCreate();
        return view('pages.admin.guru.create', compact('forms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'nuptk' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'telepon' => 'required|numeric',
            'jenis_kelamin' => 'required',
            'password' => 'required|min:8',
        ]);

        try {
            $this->guruService->create($validated);
            return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $guru)
    {
        $dataDiri = $this->guruService->getDataDiriGuru($guru);

        return view('pages.admin.guru.show', compact('guru', 'dataDiri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guru $guru)
    {
        $forms = $this->guruService->getFormEdit($guru);

        return view('pages.admin.guru.edit', compact('guru', 'forms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guru $guru)
    {

        $validated = $request->validate([
            'name' => 'required',
            'nuptk' => 'required|numeric',
            'email' => 'required|email|unique:users,email,' . $guru->user->id,
            'telepon' => 'required|numeric',
            'jenis_kelamin' => 'required',
        ]);

        try {
            $this->guruService->update($validated, $guru);
            return redirect()->route('admin.guru.show', $guru->id)->with('success', 'Guru berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru)
    {
        try {
            $this->guruService->delete($guru);
            return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
