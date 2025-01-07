<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Service\MataPelajaranService;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{

    public function __construct(
        protected MataPelajaranService $mataPelajaranService,
    ) {}



    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('pages.admin.mata-pelajaran.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::currentTahunAkademik()->get()
            ->map(
                function ($item) {
                    return (object) [
                        'value' => $item->id,
                        'label' => $item->fullName,
                    ];
                }
            );

        $guru = Guru::all()
            ->map(
                function ($item) {
                    return (object) [
                        'value' => $item->id,
                        'label' => $item->user->name,
                    ];
                }
            );

        return view('pages.admin.mata-pelajaran.create', compact('kelas', 'guru'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'kelas_id' => 'required',
            'guru_id' => 'required',
        ]);

        try {

            $this->mataPelajaranService->create($validated);

            return redirect()->route('admin.mata-pelajaran.index')->with('success', 'Mata Pelajaran berhasil ditambahkan');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', 'Mata Pelajaran gagal ditambahkan ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
