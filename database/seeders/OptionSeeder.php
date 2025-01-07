<?php

namespace Database\Seeders;

use App\Models\OptionCategory;
use App\Services\OptionService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{

    public function __construct(protected OptionService $optionService) {}

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // jenis kelamin
        OptionCategory::insert([
            [
                'key' => 'jenis_kelamin',
                'name' => 'Jenis Kelamin'
            ],
            [
                'key' => 'agama',
                'name' => 'Agama'
            ],
            [
                'key' => 'status_keluarga',
                'name' => 'Status Keluarga'
            ],
            [
                'key' => 'tingkat_kelas',
                'name' => 'Tingkat Kelas'
            ],
            [
                'key' => 'hari',
                'name' => 'Hari'
            ]
        ]);

        $jenisKelamin = $this->optionService->getOptionCategoryKey('jenis_kelamin');

        $jenisKelamin->options()->createMany([
            ['name' => 'L'],
            ['name' => 'P'],
        ]);

        $agama = $this->optionService->getOptionCategoryKey('agama');

        $agama->options()->createMany([
            ['name' => 'Islam'],
            ['name' => 'Kristen'],
            ['name' => 'Katolik'],
            ['name' => 'Hindu'],
            ['name' => 'Budha'],
            ['name' => 'Konghucu'],
        ]);

        $statusKeluarga = $this->optionService->getOptionCategoryKey('status_keluarga');

        $statusKeluarga->options()->createMany([
            ['name' => 'Anak Kandung'],
            ['name' => 'Anak Tiri'],
            ['name' => 'Anak Angkat'],
        ]);

        $tingkatKelas = $this->optionService->getOptionCategoryKey('tingkat_kelas');
        $tingkatKelas->options()->createMany([
            ['name' => 'X'],
            ['name' => 'XI'],
            ['name' => 'XII'],
        ]);

        $hari = $this->optionService->getOptionCategoryKey('hari');
        $hari->options()->createMany([
            ['name' => 'Senin'],
            ['name' => 'Selasa'],
            ['name' => 'Rabu'],
            ['name' => 'Kamis'],
            ['name' => 'Jumat'],
            ['name' => 'Sabtu'],
            ['name' => 'Minggu'],
        ]);
    }
}
