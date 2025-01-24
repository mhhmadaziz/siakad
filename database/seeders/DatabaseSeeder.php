<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\OptionService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('public');

        $this->call(OptionSeeder::class);

        $admin = Role::create(['name' => 'admin']);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ])->assignRole($admin);

        $this->call([
            GuruSeeder::class,
            SiswaSeeder::class,
            TahunAkademikSeeder::class,
            KelasSeeder::class,
            /*MataPelajaranSeeder::class,*/
            /*JadwalMataPelajaranSeeder::class,*/
        ]);

        cache()->flush();
    }
}
