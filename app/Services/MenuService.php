<?php

namespace App\Services;

use App\Models\Menu;
use Illuminate\Support\Facades\Cache;

class MenuService
{
    public function __construct() {}

    public function dashboardMenu()
    {
        return Cache::remember('dashboard_menu', 3600, function () {
            return Menu::query()
                ->with('location', 'status')
                ->whereHas('location', function ($query) {
                    $query->where('name', 'dashboard');
                })
                ->whereHas('status', function ($query) {
                    $query->where('name', 'Aktif');
                })
                ->get();
        });
    }

    public function homeMenu()
    {
        return Cache::remember('home_menu', 3600, function () {
            return Menu::query()
                ->with('location', 'status')
                ->whereHas('location', function ($query) {
                    $query->where('name', 'home');
                })
                ->whereHas('status', function ($query) {
                    $query->where('name', 'Aktif');
                })
                ->get();
        });
    }
}
