<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /*protected $fillable = [*/
        /*    'name',*/
        /*    'nomor',*/
        /*    'kelas',*/
        /*    'tahun_akademik_id',*/
        /*];*/

        Kelas::insert([
            [
                'name' => 'X-1 (Sepuluh Satu)',
                'nomor' => 1,
                'kelas' => 'X',
                'tahun_akademik_id' => 1,
            ],
            [
                'name' => 'X-2 (Sepuluh Dua)',
                'nomor' => 2,
                'kelas' => 'X',
                'tahun_akademik_id' => 1,
            ],
            [
                'name' => 'X-3 (Sepuluh Tiga)',
                'nomor' => 3,
                'kelas' => 'X',
                'tahun_akademik_id' => 1,
            ],
            [
                'name' => 'XI-1 (Sebelas Satu)',
                'nomor' => 1,
                'kelas' => 'XI',
                'tahun_akademik_id' => 1,
            ],
            [
                'name' => 'XI-2 (Sebelas Dua)',
                'nomor' => 2,
                'kelas' => 'XI',
                'tahun_akademik_id' => 1,
            ],
            [
                'name' => 'XI-3 (Sebelas Tiga)',
                'nomor' => 3,
                'kelas' => 'XI',
                'tahun_akademik_id' => 1,
            ],
            [
                'name' => 'XII-1 (Dua Belas Satu)',
                'nomor' => 1,
                'kelas' => 'XII',
                'tahun_akademik_id' => 1,
            ],
            [
                'name' => 'XII-2 (Dua Belas Dua)',
                'nomor' => 2,
                'kelas' => 'XII',
                'tahun_akademik_id' => 1,
            ],
            [
                'name' => 'XII-3 (Dua Belas Tiga)',
                'nomor' => 3,
                'kelas' => 'XII',
                'tahun_akademik_id' => 1,
            ]
        ]);
    }
}
