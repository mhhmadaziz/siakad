<?php

namespace Database\Seeders;

use App\Models\User;
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

        User::factory()
            ->count(80)
            ->create()
            ->each(function ($user) use ($guru) {
                $user->assignRole($guru);
                $user->guru()->create([
                    'nuptk' => fake()->unique()->randomNumber(8),
                ]);
            });
    }
}
