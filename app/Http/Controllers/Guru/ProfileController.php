<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Services\GuruService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{

    public function __construct(
        protected GuruService $guruService
    ) {}

    public function index()
    {
        $user = auth()->user();
        $guru = auth()->user()->guru;

        $forms = $this->guruService->getFormEdit($guru, [
            'nuptk'
        ]);

        // hapus kolom email dari variable forms
        $forms = collect($forms)->filter(function ($form) {
            return $form->name !== 'email';
        })->toArray();

        return view('pages.guru.profile.index', compact('forms', 'guru', 'user'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'telepon' => 'required|numeric',
            'jenis_kelamin' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $guru = auth()->user()->guru;
            $this->guruService->update($validated, $guru);

            DB::commit();

            return redirect()->back()->with('success', 'Berhasil mengubah data diri');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengubah data diri ' . $th->getMessage());
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
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengubah data akun');
        }
    }
}
