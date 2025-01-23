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

        $jenisKelaminId = app(OptionService::class)->getOptionValueByName('L')->id;
        $siswaUser = User::create([
            'name' => 'Siswa',
            'email' => 'siswa@siswa.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'jenis_kelamin_id' => $jenisKelaminId,
        ]);
        $siswaUser->assignRole($siswa);
        $siswaUser->siswa()->create([
            'nisn' => '12345678',
            'nipd' => '12345678',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '2000-01-01',
            'agama_id' => $agamaId->random(),
            'alamat' => 'Jl. Jalan',
            'rt' => '001',
            'rw' => '001',
            'dusun' => 'Dusun',
            'kelurahan' => 'Kelurahan',
            'kecamatan' => 'Kecamatan',
            'nama_ayah' => 'Ayah',
            'nama_ibu' => 'Ibu',
        ]);

        $siswaUser = User::create([
            'name' => 'Siswa2',
            'email' => 'siswa2@siswa.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'jenis_kelamin_id' => $jenisKelaminId,
        ]);

        $siswaUser->assignRole($siswa);
        $siswaUser->siswa()->create([
            'nisn' => '12345679',
            'nipd' => '12345679',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '2000-01-01',
            'agama_id' => $agamaId->random(),
            'alamat' => 'Jl. Jalan',
            'rt' => '001',
            'rw' => '001',
            'dusun' => 'Dusun',
            'kelurahan' => 'Kelurahan',
            'kecamatan' => 'Kecamatan',
            'nama_ayah' => 'Ayah',
            'nama_ibu' => 'Ibu',
        ]);
    }
}
