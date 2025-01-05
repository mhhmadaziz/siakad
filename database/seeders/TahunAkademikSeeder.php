<?php

namespace Database\Seeders;

use App\Models\TahunAkademik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TahunAkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        TahunAkademik::insert([
            [
                'name' => '2021/2022',
                'mulai' => '2021-07-01',
                'selesai' => '2022-06-30',
            ],
            [
                'name' => '2022/2023',
                'mulai' => '2022-07-01',
                'selesai' => '2023-06-30',
            ],
            [
                'name' => '2023/2024',
                'mulai' => '2023-07-01',
                'selesai' => '2024-06-30',
            ],
            [
                'name' => '2024/2025',
                'mulai' => '2024-07-01',
                'selesai' => '2025-06-30',
            ],
            [
                'name' => '2025/2026',
                'mulai' => '2025-07-01',
                'selesai' => '2026-06-30',
            ],
        ]);
    }
}
