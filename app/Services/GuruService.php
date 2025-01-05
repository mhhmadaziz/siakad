<?php

namespace App\Services;

use App\Enums\JenisKelaminEnum;
use App\Models\Guru;
use Illuminate\Support\Facades\Cache;

class GuruService
{
    public function __construct()
    {
        //
    }


    public function getJumlahGuru()
    {
        return Cache::remember('guru.jumlah', now()->addHours(1), function () {
            return (object) [
                'total' => Guru::count(),
                'lakiLaki' => Guru::whereHas('user.jenisKelamin', function ($q) {
                        $q->where('name', JenisKelaminEnum::LAKILAKI->value);
                    })->count(),
                'perempuan' => Guru::whereHas('user.jenisKelamin', function ($q) {
                    $q->where('name', JenisKelaminEnum::PEREMPUAN->value);
                })->count(),
            ];
        });
    }
}
