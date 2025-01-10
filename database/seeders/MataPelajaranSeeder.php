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


        \App\Models\Kelas::all()->each(function ($kelas) {

            $guru_ids = \App\Models\Guru::pluck('id');
            $mata_pelajarans = [
                [
                    'name' => 'Matematika',
                    'guru_id' => $guru_ids->random(),
                ],
                [
                    'name' => 'Bahasa Indonesia',
                    'guru_id' => $guru_ids->random(),
                ],
                [
                    'name' => 'Bahasa Inggris',
                    'guru_id' => $guru_ids->random(),
                ],
                [
                    'name' => 'IPA',
                    'guru_id' => $guru_ids->random(),
                ],
                [
                    'name' => 'IPS',
                    'guru_id' => $guru_ids->random(),
                ],
                [
                    'name' => 'PKN',
                    'guru_id' => $guru_ids->random(),
                ],
                [
                    'name' => 'PJOK',
                    'guru_id' => $guru_ids->random(),
                ],
                [
                    'name' => 'Seni Budaya',
                    'guru_id' => $guru_ids->random(),
                ],
            ];

            $kelas->mataPelajarans()->createMany($mata_pelajarans);
        });
    }
}
