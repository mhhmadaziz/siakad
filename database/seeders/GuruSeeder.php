<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\OptionService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guru = Role::create(['name' => 'guru']);

        /*User::factory()*/
        /*    ->count(80)*/
        /*    ->create()*/
        /*    ->each(function ($user) use ($guru) {*/
        /*        $user->assignRole($guru);*/
        /*        $user->guru()->create([*/
        /*            'nuptk' => fake()->unique()->randomNumber(8),*/
        /*        ]);*/
        /*    });*/

        $jenisKelaminId = app(OptionService::class)->getOptionValueByName('L')->id;

        $guruUser = User::create([
            'name' => 'Guru',
            'email' => 'guru@guru.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'jenis_kelamin_id' => $jenisKelaminId,
        ]);
        $guruUser->assignRole($guru);
        $guruUser->guru()->create([
            'nuptk' => '12345678',
        ]);
    }
}
