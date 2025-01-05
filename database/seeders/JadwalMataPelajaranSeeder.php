<?php

namespace Database\Seeders;

use App\Models\JadwalMataPelajaran;
use App\Models\MataPelajaran;
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

        $jadwals = collect(range(1, 50))->map(function () use ($mataPelajaranIds) {
            return [
                'hari' => collect(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'])->random(),
                'jam_mulai' => Carbon::createFromTime(rand(7, 10), rand(0, 59), 0)->format('H:i:s'),
                'jam_selesai' => Carbon::createFromTime(rand(11, 15), rand(0, 59), 0)->format('H:i:s'),
                'mata_pelajaran_id' => $mataPelajaranIds->random(),

            ];
        })->toArray();

        JadwalMataPelajaran::insert(
            $jadwals
        );
    }
}
