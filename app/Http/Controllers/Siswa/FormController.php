<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiswaFormRequest;
use App\Models\JawabanSiswa;
use App\Models\Pertanyaan;
use App\Service\CmsService;
use App\Services\TahunAkademikService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    protected $pertanyaans;

    public function __construct(
        protected CmsService $cmsService
    ) {
        $this->pertanyaans = Cache::remember('pertanyaans_current', 60 * 60 * 24, function () {
            return Pertanyaan::currentTahunAkademik()->get();
        });
    }

    public function index()
    {

        $bukaKuisioner = $this->cmsService->getCms('buka_kuisioner') == 'true' ? true : false;

        if (!$bukaKuisioner) {
            return view('pages.siswa.form.close');
        }

        $foundJawabanSiswa = JawabanSiswa::query()
            ->currentTahunAkademik()
            ->where('siswa_id', auth()->user()->siswa->id)
            ->exists();

        if ($foundJawabanSiswa) {
            return view('pages.siswa.form.submited');
        }

        $pertanyaans = $this->pertanyaans;
        return view('pages.siswa.form.index', compact('pertanyaans'));
    }

    public function show()
    {
        $jawabanSiswa = JawabanSiswa::query()
            ->currentTahunAkademik()
            ->with('jawabans', 'jawabans.pertanyaan')
            ->where('siswa_id', auth()->user()->siswa->id)
            ->first();

        if (!$jawabanSiswa) {
            return redirect()->route('siswa.form.index');
        }

        return view('pages.siswa.form.show', compact('jawabanSiswa'));
    }

    public function submit(SiswaFormRequest $request)
    {
        $validated = $request->validated();
        try {

            DB::beginTransaction();
            $jawabanSiswa = JawabanSiswa::create([
                'siswa_id' => auth()->user()->siswa->id,
                'tahun_akademik_id' => app(TahunAkademikService::class)->getCurrentTahunAkademik()->id,
            ]);

            foreach ($this->pertanyaans as $pertanyaan) {
                $jawaban = $validated['pertanyaan_' . $pertanyaan->id];

                if ($pertanyaan->tipeInput == 'checkbox') {
                    $jawaban = json_encode($jawaban);
                }

                $jawabanSiswa->jawabans()->create([
                    'pertanyaan_id' => $pertanyaan->id,
                    'jawaban' => $jawaban,
                ]);
            }


            DB::commit();
            return redirect()->back()->with('success', 'Form berhasil dikirim');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirimkan form ' . $th->getMessage());
        }
    }
}
