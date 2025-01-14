<?php

namespace App\Services;

use App\Models\TahunAkademik;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $tahunAkademik = TahunAkademik::create($data);
            Cache::forget('all_tahun_akademik');
            Cache::forget('current_tahun_akademik');
            return $tahunAkademik;
        });
    }

    public function update(TahunAkademik $tahunAkademik, array $data)
    {
        return DB::transaction(function () use ($tahunAkademik, $data) {
            $tahunAkademik->update($data);
            Cache::forget('all_tahun_akademik');
            Cache::forget('current_tahun_akademik');
            return $tahunAkademik;
        });
    }

    public function createKelas(TahunAkademik $tahunAkademik, array $data)
    {
        return DB::transaction(function () use ($tahunAkademik, $data) {
            $kelas = $tahunAkademik->kelas()->create($data);
            return $kelas;
        });
    }


    public function uploadPpdb(TahunAkademik $tahunAkademik, $file)
    {
        return DB::transaction(function () use ($tahunAkademik, $file) {
            $fileName = $file->hashName();

            $tahunAkademik->update([
                'file_ppdb' => $fileName,
            ]);

            Storage::disk('public')->putFileAs('ppdb', $file, $fileName);
            Cache::forget('current_tahun_akademik');
            return $tahunAkademik;
        });
    }

    public function deletePpdb(TahunAkademik $tahunAkademik)
    {
        return DB::transaction(function () use ($tahunAkademik) {
            Storage::disk('public')->delete('ppdb/' . $tahunAkademik->file_ppdb);

            $tahunAkademik->update([
                'file_ppdb' => null,
            ]);

            Cache::forget('current_tahun_akademik');
            return $tahunAkademik;
        });
    }
}
