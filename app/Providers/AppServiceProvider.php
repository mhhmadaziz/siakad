<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (config('app.env') === 'production') {
            $this->app['request']->server->set('HTTPS', true);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        //
        Blade::directive('normalCase', function ($expression) {
            // return from snake_case to normal case with ucwords
            return "<?php echo ucwords(str_replace('_', ' ', $expression)); ?>";
        });

        Carbon::setLocale('id');
    }
}
