<?php

namespace App\Service;

use App\Models\MataPelajaran;
use Illuminate\Support\Facades\DB;

class MataPelajaranService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $mataPelajaran = MataPelajaran::create($data);
            return $mataPelajaran;
        });
    }

    public function delete(MataPelajaran $mataPelajaran)
    {
        return DB::transaction(function () use ($mataPelajaran) {

            $mataPelajaran->modulPembelajarans()->delete();
            $mataPelajaran->jadwalMataPelajarans->each(function ($jadwal) {
                $jadwal->kehadiranSiswas->each(function ($kehadiran) {
                    $kehadiran->kehadiranSiswaChildren()->delete();
                    $kehadiran->delete();
                });
            });
            $mataPelajaran->jadwalMataPelajarans()->delete();

            $mataPelajaran->delete();
            return $mataPelajaran;
        });
    }

    public function update(MataPelajaran $mataPelajaran, array $data)
    {
        return DB::transaction(function () use ($mataPelajaran, $data) {
            $mataPelajaran->update($data);
            return $mataPelajaran;
        });
    }
}
