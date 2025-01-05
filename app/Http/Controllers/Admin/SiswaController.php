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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        $dataDiri = $this->siswaService->getDataDiriSiswa($siswa);
        $dataOrangTua = $this->siswaService->getDataOrangTuaSiswa($siswa);
        return view('pages.admin.siswa.show', compact('dataDiri', 'siswa', 'dataOrangTua'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        $formDataDiri = $this->siswaService->getFormEditDataDiriSiswa($siswa);
        $formOrangTua = $this->siswaService->getFormEditOrangTuaSiswa($siswa);

        $forms = [
            ...$formDataDiri,
            ...$formOrangTua
        ];
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
            'nama_lengkap' => 'nullable',
            'nomor_induk_siswa_nasional' => 'nullable',
            'tempat_lahir_tanggal_lahir' => 'nullable',
            'jenis_kelamin' => 'nullable',
            'status_dalam_keluarga' => 'nullable',
            'anak_ke' => 'nullable',
            'agama' => 'nullable',
            'alamat' => 'nullable',
            'nomor_telepon' => 'nullable',
            'asal_sekolah' => 'nullable',
            'tanggal_diterima' => 'nullable',
            'diterima_dikelas' => 'nullable',
            'diterima_di_kelas' => 'nullable',
            'kelas_saat_ini' => 'nullable',
            'status' => 'nullable',
            'nama_ayah' => 'nullable',
            'nama_ibu' => 'nullable',
            'alamat_orang_tua' => 'nullable',
            'pekerjaan_ayah' => 'nullable',
            'pekerjaan_ibu' => 'nullable',
            'nomor_telepon_ayah' => 'nullable',
            'nomor_telepon_ibu' => 'nullable',
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
    public function destroy(string $id)
    {
        //
    }
}
