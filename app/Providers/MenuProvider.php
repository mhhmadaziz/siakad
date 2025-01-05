<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Services\MenuService;

class MenuProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(MenuService::class, function () {
            return new MenuService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $menuService = app(MenuService::class);
            $view->with([
                'dashboardMenu' => $menuService->dashboardMenu(),
                'homeMenu' => $menuService->homeMenu(),
            ]);
        });
    }
}
