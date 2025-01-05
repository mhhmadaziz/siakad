<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MataPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*protected $fillable = [*/
        /*    'name',*/
        /*    'kelas_id',*/
        /*    'guru_id',*/
        /*];*/

        $kelas_ids = \App\Models\Kelas::pluck('id');
        $guru_ids = \App\Models\Guru::pluck('id');

        $mata_pelajarans = [
            [
                'name' => 'Matematika',
                'kelas_id' => $kelas_ids->random(),
                'guru_id' => $guru_ids->random(),
            ],
            [
                'name' => 'Bahasa Indonesia',
                'kelas_id' => $kelas_ids->random(),
                'guru_id' => $guru_ids->random(),
            ],
            [
                'name' => 'Bahasa Inggris',
                'kelas_id' => $kelas_ids->random(),
                'guru_id' => $guru_ids->random(),
            ],
            [
                'name' => 'IPA',
                'kelas_id' => $kelas_ids->random(),
                'guru_id' => $guru_ids->random(),
            ],
            [
                'name' => 'IPS',
                'kelas_id' => $kelas_ids->random(),
                'guru_id' => $guru_ids->random(),
            ],
            [
                'name' => 'PKN',
                'kelas_id' => $kelas_ids->random(),
                'guru_id' => $guru_ids->random(),
            ],
            [
                'name' => 'PJOK',
                'kelas_id' => $kelas_ids->random(),
                'guru_id' => $guru_ids->random(),
            ],
            [
                'name' => 'Seni Budaya',
                'kelas_id' => $kelas_ids->random(),
                'guru_id' => $guru_ids->random(),
            ],
        ];

        MataPelajaran::insert($mata_pelajarans);
    }
}
