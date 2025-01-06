<?php

namespace App\Services;

use App\Models\Kelas;
use App\Models\TahunAkademik;

class KelasService
{
    /**
     * Create a new class instance.
     */

    protected TahunAkademikService $tahunAkademikService;
    protected OptionService $optionService;
    public function __construct()
    {
        $this->tahunAkademikService = app(TahunAkademikService::class);
        $this->optionService = app(OptionService::class);
    }

    public function createBulk(TahunAkademik $tahunAkademik)
    {

        $tingkatKelass  = $this->optionService->getOptionsByCategoryKey('tingkat_kelas');

        foreach ($tingkatKelass as $key => $value) {

            foreach (['A', 'B', 'C'] as $kelas) {
                Kelas::create([
                    'name' => $value . '-' . $kelas,
                    'tingkat_kelas_id' => $key,
                    'tahun_akademik_id' => $tahunAkademik->id,
                ]);
            }
        }
    }
}
