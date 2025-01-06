<?php

namespace App\Services;

use App\Models\TahunAkademik;
use Illuminate\Support\Facades\Cache;

class TahunAkademikService
{
    public function __construct() {}

    public function getCurrentTahunAkademik()
    {
        return Cache::remember(
            'current_tahun_akademik',
            3600,
            function () {
                $sekarang = now();
                return TahunAkademik::where('mulai', '<=', $sekarang)
                    ->where('selesai', '>=', $sekarang)
                    ->first() ?? TahunAkademik::query()->latest()->first();
            }
        );
    }

    public function getAllTahunAkademik()
    {
        return Cache::remember(
            'all_tahun_akademik',
            3600,
            function () {
                return TahunAkademik::query()->orderBy('mulai', 'desc')->get();
            }
        );
    }
}
