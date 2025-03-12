<?php
namespace ITHilbert\Sitemap;

use Illuminate\Support\Facades\Route;

class RouteMacros
{
    public static function register()
    {
        // Macro für `priority`
        Route::macro('priority', function ($priority = null) {
            $default = config('sitemap.defaults.priority', '0.5');
            Route::defaults(['priority' => $priority ?? $default]);
            return $this;
        });

        // Macro für `changefreq`
        Route::macro('changefreq', function ($changefreq = null) {
            $default = config('sitemap.defaults.changefreq', 'weekly');
            Route::defaults(['changefreq' => $changefreq ?? $default]);
            return $this;
        });

        // Macro für `noIndex`
        Route::macro('noIndex', function () {
            Route::defaults(['noIndex' => true]);
            return $this;
        });
    }
}
