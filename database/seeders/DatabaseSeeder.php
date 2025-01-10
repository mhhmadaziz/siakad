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

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ])->assignRole($admin);

        $this->call([
            GuruSeeder::class,
            SiswaSeeder::class,
            TahunAkademikSeeder::class,
            KelasSeeder::class,
            MataPelajaranSeeder::class,
            JadwalMataPelajaranSeeder::class,
        ]);

        cache()->flush();
    }
}
