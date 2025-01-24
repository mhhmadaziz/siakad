<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Services\KelasService;
use App\Services\OptionService;
use App\Services\TahunAkademikService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*$currentTahunAkademik = app(TahunAkademikService::class)->getCurrentTahunAkademik();*/
        /*app(KelasService::class)->createBulk($currentTahunAkademik);*/
    }
}
