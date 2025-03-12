<?php

namespace ITHilbert\Sitemap;

use Illuminate\Support\ServiceProvider;
use ITHilbert\Sitemap\RouteMacros;

class SitemapServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/sitemap.php', 'sitemap');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }

    public function boot()
    {
        // Routen-Macros registrieren
        RouteMacros::register();

        // Konfigurationsdatei veröffentlichen
        $this->publishes([
            __DIR__.'/config/sitemap.php' => config_path('sitemap.php'),
        ], 'config');

        // View veröffentlichen
        $this->publishes([
            __DIR__.'/views/sitemap.blade.php' => resource_path('views/sitemap.blade.php'),
        ], 'views');
    }
}
