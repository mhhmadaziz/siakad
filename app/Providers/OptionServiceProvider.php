<?php

namespace App\Providers;

use App\Services\OptionService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class OptionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(OptionService::class, function () {
            return new OptionService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $optionService = app(OptionService::class);
            $view->with('optionService', $optionService);
        });
    }
}
