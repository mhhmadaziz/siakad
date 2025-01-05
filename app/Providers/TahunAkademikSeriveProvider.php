<?php

namespace App\Providers;

use App\Services\TahunAkademikService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class TahunAkademikSeriveProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(TahunAkademikService::class, function () {
            return new TahunAkademikService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $tahunAkademikService = app(TahunAkademikService::class);

            $view->with([
                'currentTahunAkademik' => $tahunAkademikService->getCurrentTahunAkademik(),
                'upcomingTahunAkademik' => $tahunAkademikService->getUpcomingTahunAkademik()
            ]);
        });
    }
}
