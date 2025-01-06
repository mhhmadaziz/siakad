<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MenuProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void {}

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $menuJson = file_get_contents(base_path('resources/menu/menu.json'));
            $menuData = json_decode($menuJson);
            $view->with([
                'menuData' => $menuData
            ]);
        });
    }
}
