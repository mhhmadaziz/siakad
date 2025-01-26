<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        // Allow for both HTTP and HTTPS requests
        Request::macro('hasValidSignature', function ($absolute = true, array $ignoreQuery = []) {
            $https = clone $this;
            $https->server->set('HTTPS', 'on');

            $http = clone $this;
            $http->server->set('HTTPS', 'off');

            return URL::hasValidSignature($https, $absolute, $ignoreQuery)
                || URL::hasValidSignature($http, $absolute, $ignoreQuery);
        });
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
