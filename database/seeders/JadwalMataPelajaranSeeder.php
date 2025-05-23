<?php

namespace Database\Seeders;

use App\Models\JadwalMataPelajaran;
use App\Models\MataPelajaran;
use App\Services\OptionService;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalMataPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mataPelajaranIds = MataPelajaran::pluck('id');
        $hariIds = app(OptionService::class)->getOptionCategoryKey('hari')->options->pluck('id');


        foreach ($mataPelajaranIds as $mataPelajaranId) {
            $jadwals = collect(range(1, 8))->map(function () use ($hariIds, $mataPelajaranId) {
                return [
                    'jam_mulai' => Carbon::createFromTime(rand(7, 10), rand(0, 59), 0)->format('H:i:s'),
                    'jam_selesai' => Carbon::createFromTime(rand(11, 15), rand(0, 59), 0)->format('H:i:s'),
                    'mata_pelajaran_id' => $mataPelajaranId,
                    'hari_id' => $hariIds->random(),
                ];
            })->toArray();

            JadwalMataPelajaran::insert(
                $jadwals
            );
        }
    }
}
