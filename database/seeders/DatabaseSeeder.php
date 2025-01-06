<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\OptionService;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(OptionSeeder::class);

        $admin = Role::create(['name' => 'admin']);
        $guru = Role::create(['name' => 'guru']);
        $siswa = Role::create(['name' => 'siswa']);

        $agamas = (new OptionService())->getOptionsByCategoryKey('agama');

        $statusKeluarga = (new OptionService())->getOptionsByCategoryKey('status_keluarga');


        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ])->assignRole($admin);

        User::factory(100)->create()->each(function ($user) use ($guru, $siswa, $agamas, $statusKeluarga) {
            if ($user->id % 2 == 0) {
                $user->assignRole($guru);
                $user->guru()->create([
                    'nuptk' => $user->id . '1234567890',
                ]);
            } else {
                $user->assignRole($siswa);
                $user->siswa()->create([
                    'nisn' => $user->id . '1234567890',
                    'status_keluarga_id' => array_rand($statusKeluarga),
                    'ttl' => fake()->city() . ', ' . fake()->date(),
                    'agama_id' => array_rand($agamas),
                    'anak_ke' => fake()->numberBetween(1, 10),
                    'alamat' => fake()->address(),
                    'asal_sekolah' => fake()->company(),
                    'tgl_masuk' => fake()->date(),
                    'diterima_kelas' => fake()->randomElement(['X', 'XI', 'XII']),
                    'status' => fake()->randomElement(['Aktif', 'Tidak Aktif']),
                ]);
            }
        });

        $this->call([
            TahunAkademikSeeder::class,
            KelasSeeder::class,
            MataPelajaranSeeder::class,
            JadwalMataPelajaranSeeder::class,
        ]);

        // clear all cache
        cache()->flush();
    }
}
