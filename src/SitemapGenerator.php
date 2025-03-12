<?php
namespace ITHilbert\Sitemap;

use Illuminate\Support\Facades\Route;

class SitemapGenerator
{
    public static function generate()
    {
        $excludedPatterns = config('sitemap.exclude.exact', []);
        $excludedPrefixes = config('sitemap.exclude.prefix', []);
        $excludedSuffixes = config('sitemap.exclude.suffix', []);

        $routes = collect(Route::getRoutes())->filter(function ($route) use ($excludedPatterns, $excludedPrefixes, $excludedSuffixes) {
            $methods = $route->methods();
            $uri = $route->uri();

            // 1. Nur GET- und ANY-Routen erlauben
            if (!in_array('GET', $methods) && !in_array('ANY', $methods)) {
                return false;
            }

            // 2. Routen mit `{...}`-Platzhaltern ausschließen
            if (strpos($uri, '{') !== false) {
                return false;
            }

            // 3. Routen, die mit `_` beginnen, ausschließen
            if (str_starts_with($uri, '_')) {
                return false;
            }

            // 4. Exakte Ausschlüsse aus der Konfigurationsdatei
            foreach ($excludedPatterns as $pattern) {
                if (fnmatch($pattern, $uri)) {
                    return false;
                }
            }

            // 5. Ausschluss nach Präfix (Routen, die mit bestimmten Begriffen beginnen)
            foreach ($excludedPrefixes as $prefix) {
                if (str_starts_with($uri, $prefix)) {
                    return false;
                }
            }

            // 6. Ausschluss nach Suffix (Routen, die mit bestimmten Begriffen enden)
            foreach ($excludedSuffixes as $suffix) {
                if (str_ends_with($uri, $suffix)) {
                    return false;
                }
            }

            return true;
        })->map(function ($route) {
            return [
                'url' => url($route->uri()),
                'changefreq' => $route->defaults['changefreq'] ?? config('sitemap.defaults.changefreq'),
                'priority' => $route->defaults['priority'] ?? config('sitemap.defaults.priority')
            ];
        });

        return $routes;
    }
}