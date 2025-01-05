<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuLocation;
use App\Models\MenuStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create many menu statuses

        MenuStatus::insert([
            [
                'name' => 'Aktif',
            ],
            [
                'name' => 'Tidak Aktif',
            ]
        ]);

        // create many menu locations
        MenuLocation::insert([
            [
                'name' => 'home',
            ],
            [
                'name' => 'dashboard',
            ],
        ]);

        // create many menus
        $menus = [
            [
                'label' => 'Beranda',
                'route' => 'home.index',
                'icon' => 'fas fa-home',
                'menu_status_id' => 1,
                'menu_location_id' => 1,
            ],
            [
                'label' => 'Galeri',
                'route' => 'home.galeri',
                'icon' => 'fas fa-images',
                'menu_status_id' => 1,
                'menu_location_id' => 1,
            ],
            [
                'label' => 'Kalender',
                'route' => 'home.kalender',
                'icon' => 'fas fa-calendar-alt',
                'menu_status_id' => 1,
                'menu_location_id' => 1,
            ],
            [
                'label' => 'PPDB',
                'route' => 'home.ppdb',
                'icon' => 'fas fa-school',
                'menu_status_id' => 1,
                'menu_location_id' => 1,
            ]
        ];

        Menu::insert($menus);

        $dashboardMenu = [
            [
                'label' => 'Dashboard',
                'route' => 'admin.dashboard',
                'icon' => 'fa-solid fa-house',
                'menu_status_id' => 1,
                'menu_location_id' => 2,
            ],
            [
                'label' => 'Tahun Ajaran',
                'route' => 'admin.tahun-akademik.index',
                'icon' => 'fa-solid fa-graduation-cap',
                'menu_status_id' => 1,
                'menu_location_id' => 2,
            ],
            [
                'label' => 'Data Guru',
                'route' => 'admin.guru.index',
                'icon' => 'fa-solid fa-person-chalkboard',
                'menu_status_id' => 1,
                'menu_location_id' => 2,
            ],
            [
                'label' => 'Data Siswa',
                'route' => 'admin.siswa.index',
                'icon' => 'fa-solid fa-user-graduate',
                'menu_status_id' => 1,
                'menu_location_id' => 2,
            ],
            [
                'label' => 'Jadwal Mata Pelajaran',
                'route' => 'admin.jadwal-mata-pelajaran.index',
                'icon' => 'fa-solid fa-calendar-days',
                'menu_status_id' => 1,
                'menu_location_id' => 2,
            ],
            [
                'label' => 'Modul Pembelajaran',
                'route' => 'admin.modul-pembelajaran.index',
                'icon' => 'fa-solid fa-book',
                'menu_status_id' => 1,
                'menu_location_id' => 2,
            ],
            [
                'label' => 'Kelola Kelas',
                'route' => 'admin.kelas.index',
                'icon' => 'fa-solid fa-door-closed',
                'menu_status_id' => 1,
                'menu_location_id' => 2,
            ],
            [
                'label' => 'Kehadiran Siswa',
                'route' => 'dashboard',
                'icon' => 'fa-solid fa-user-check',
                'menu_status_id' => 1,
                'menu_location_id' => 2,
            ],
            [
                'label' => 'Pemilihan Mata Pelajaran Pilihan',
                'route' => 'dashboard',
                'icon' => 'fa-solid fa-clipboard-list',
                'menu_status_id' => 1,
                'menu_location_id' => 2,
            ],
        ];

        Menu::insert($dashboardMenu);
    }
}
