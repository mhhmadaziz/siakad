<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\OptionService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class SiswaSeeder extends Seeder
{

    public function __construct(protected OptionService $optionService) {}
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswa = Role::create(['name' => 'siswa']);

        $agamaId = app(OptionService::class)->getOptionCategoryKey('agama')->options->pluck('id');

        User::factory()
            ->count(80)
            ->create()
            ->each(function ($user) use ($siswa, $agamaId) {
                $user->assignRole($siswa);
                $user->siswa()->create([
                    'nisn' => fake()->unique()->randomNumber(8),
                    'nipd' => fake()->unique()->randomNumber(8),
                    'tempat_lahir' => fake()->city,
                    'tanggal_lahir' => fake()->date,
                    'agama_id' => $agamaId->random(),
                    'alamat' => fake()->address,
                    'rt' => fake()->randomNumber(3),
                    'rw' => fake()->randomNumber(3),
                    'dusun' => fake()->streetName,
                    'kelurahan' => fake()->streetName,
                    'kecamatan' => fake()->city,
                    'nama_ayah' => fake()->name,
                    'nama_ibu' => fake()->name,
                ]);
            });
    }
}
