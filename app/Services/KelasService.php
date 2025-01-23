<?php

namespace App\Services;

use App\Models\Kelas;
use App\Models\TahunAkademik;
use Illuminate\Support\Facades\DB;

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
                    'name' => $kelas,
                    'tingkat_kelas_id' => $key,
                    'tahun_akademik_id' => $tahunAkademik->id,
                ]);
            }
        }
    }


    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $kelas = Kelas::create($data);
            return $kelas;
        });
    }

    public function tambahSiswaKelas(Kelas $kelas,  $siswaIds)
    {
        return DB::transaction(function () use ($kelas, $siswaIds) {
            $kelas->kelasSiswa()->createMany(array_map(function ($siswaId) {
                return ['siswa_id' => $siswaId];
            }, $siswaIds));

            return $kelas;
        });
    }

    public function delete(Kelas $kelas)
    {
        return DB::transaction(function () use ($kelas) {
            $kelas->delete();
            return $kelas;
        });
    }

    public function update(Kelas $kelas, array $data)
    {
        return DB::transaction(function () use ($kelas, $data) {
            $kelas->update($data);
            return $kelas;
        });
    }
}
