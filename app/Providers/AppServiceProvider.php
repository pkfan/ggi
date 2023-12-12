<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        // vendors
        // Call to Laratrust::permission - override by Muhammad Amir
        Blade::directive('permission', function ($expression) {
            return "<?php if (app('laratrust')->hasRole(['super-admin', 'director', 'manager']) || app('laratrust')->hasPermission({$expression})) : ?>";
        });


        /////////////
        Paginator::useBootstrap();
        // define custom compents director for admin (e.g. admin::sidebar)
        Blade::anonymousComponentNamespace('admin.components', 'admin');
        Blade::anonymousComponentNamespace('officer.components', 'officer');
        Blade::anonymousComponentNamespace('supervisor.components', 'supervisor');
        Blade::anonymousComponentNamespace('legaldepartment.components','legal');
        Blade::anonymousComponentNamespace('collector.components','collector');
        
        // set locale (language ) by cofig and helpers
      //  config()->set('app.locale',  settings()->getLanguage()['code']);

    //   app()->setLocale(session('language') ?? 'en');
    //   dd(session('language'));

    }
}
