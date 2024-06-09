<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if(config('app.env') == "production") {
            //    URL::forceScheme('https');
               $this->app['request']->server->set('HTTPS','on');
            }

            Blade::directive('isAdmin', function() {
                return "<?php if(Auth::guard('admin')->check()): ?>";
            });

            Blade::directive('endisAdmin', function() {
                return "<?php endif; ?>";
            });

            Blade::directive('isBusiness', function() {
                return "<?php if(Auth::guard('business')->check()): ?>";
            });

            Blade::directive('endisBusiness', function() {
                return "<?php endif; ?>";
            });
    }
}
