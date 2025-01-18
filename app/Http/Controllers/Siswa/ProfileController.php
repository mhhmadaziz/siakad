<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Services\SiswaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function __construct(private SiswaService $siswaService) {}

    public function index()
    {

        $user = auth()->user();
        $siswa = auth()->user()->siswa;
        $forms = $this->siswaService->getFormEditDataDiriSiswa($siswa, [
            'NISN',
            'NIPD'
        ]);
        return view('pages.siswa.profile.index', compact(
            'forms',
            'siswa',
            'user'
        ));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string'],
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
            'telepon' => ['required', 'string', 'numeric'],
            'nama_ayah' => ['required', 'string'],
            'nama_ibu' => ['required', 'string'],
        ]);

        try {
            DB::beginTransaction();

            $siswa = auth()->user()->siswa;
            $this->siswaService->updateSiswa($siswa, $validated);

            DB::commit();

            return redirect()->back()->with('success', 'Berhasil mengubah data diri');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengubah data diri');
        }
    }

    public function updateAkun(Request $request)
    {
        $validated = $request->validateWithBag(
            'updateAkun',
            [
                'email' => ['required', 'email', 'unique:users,email,' . auth()->id()],
                'old_password' => ['nullable', 'current_password'],
                'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            ]
        );

        try {

            DB::beginTransaction();

            $user = auth()->user();
            if ($validated['email'] !== $user->email) {
                $user->email = $validated['email'];
                $user->email_verified_at = null;
            }

            if (isset($validated['password'])) {
                $user->password = bcrypt($validated['password']);
            }

            $user->save();

            DB::commit();

            return redirect()->back()->with('success', 'Berhasil mengubah data akun');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal mengubah data akun');
        }
    }
}
