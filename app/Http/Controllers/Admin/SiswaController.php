<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Services\SiswaService;
use Illuminate\Http\Request;

class SiswaController extends Controller
{

    public function __construct(protected SiswaService $siswaService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jumlahSiswa = $this->siswaService->getJumlahSiswa();
        return view('pages.admin.siswa.index', compact('jumlahSiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $forms = $this->siswaService->getFormCreate();
        return view('pages.admin.siswa.create', compact('forms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => ['required', 'string'],
                'jenis_kelamin_id' => ['required', 'string', 'exists:options,id'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'string', 'min:8'],
                'nisn' => ['required', 'string', 'unique:siswa,nisn'],
                'nipd' => ['required', 'string', 'unique:siswa,nipd'],
                'tempat_lahir' => ['required', 'string'],
                'tanggal_lahir' => ['required', 'date'],
                'agama_id' => ['required', 'string', 'exists:options,id'],
                'alamat' => ['required', 'string'],
                'rt' => ['required', 'string'],
                'rw' => ['required', 'string'],
                'dusun' => ['required', 'string'],
                'kelurahan' => ['required', 'string'],
                'kecamatan' => ['required', 'string'],
                'telepon' => ['required', 'numeric'],
                'nama_ayah' => ['required', 'string'],
                'nama_ibu' => ['required', 'string'],
            ]
        );

        try {
            $this->siswaService->create($validated);

            return redirect()->route('admin.siswa.index')->with('success', 'Berhasil menambahkan siswa');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menambahkan siswa. ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        $dataDiri = $this->siswaService->getDataDiriSiswa($siswa);
        return view('pages.admin.siswa.show', compact('dataDiri', 'siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        $forms = $this->siswaService->getFormEditDataDiriSiswa($siswa);

        return view('pages.admin.siswa.edit', compact(
            'siswa',
            'forms'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string'],
            'NISN' => ['required', 'string', 'unique:siswa,nisn,' . $siswa->id],
            'NIPD' => ['required', 'string', 'unique:siswa,nipd,' . $siswa->id],
            'jenis_kelamin' => ['required', 'string', 'exists:options,id'],
            'tempat_lahir' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date'],
            'agama' => ['required', 'string', 'exists:options,id'],
            'alamat' => ['required', 'string'],
            'RT' => ['required', 'string'],
            'RW' => ['required', 'string'],
            'dusun' => ['required', 'string'],
            'kelurahan' => ['required', 'string'],
            'kecamatan' => ['required', 'string'],
            'telepon' => ['required', 'string'],
            'nama_ayah' => ['required', 'string'],
            'nama_ibu' => ['required', 'string'],
        ]);

        try {
            $this->siswaService->updateSiswa($siswa, $validated);

            return redirect()->back()->with('status', 'Berhasil mengubah data siswa');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal mengubah data siswa. ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {

        try {
            $this->siswaService->delete($siswa);
            return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menghapus siswa. ' . $th->getMessage());
        }
    }
}
