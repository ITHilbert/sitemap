# ITHilbert Sitemap

Erstellt automatisch eine `sitemap.xml` auf Basis der registrierten Laravel-Routen.

## Installation

```bash
composer require ithilbert/sitemap
```

Der ServiceProvider wird über Laravel Auto-Discovery automatisch registriert.

## Konfiguration

Config-Datei veröffentlichen:

```bash
php artisan vendor:publish --provider="ITHilbert\Sitemap\SitemapServiceProvider" --tag=config
```

Die Konfigurationsdatei `config/sitemap.php` erlaubt:

| Key | Beschreibung | Standard |
|---|---|---|
| `defaults.priority` | Standard-Priorität für alle Routen | `0.5` |
| `defaults.changefreq` | Standard-Änderungsfrequenz | `monthly` |
| `exclude.exact` | Exakt auszuschließende URI-Muster (fnmatch) | `['login', ...]` |
| `exclude.prefix` | Routen, die mit diesen Präfixen beginnen, werden ausgeschlossen | `['admin', ...]` |
| `exclude.suffix` | Routen, die mit diesen Suffixen enden, werden ausgeschlossen | `['edit', ...]` |

## Aufruf

Die Sitemap ist automatisch unter folgenden URLs erreichbar — es ist kein manueller Controller notwendig:

- `/sitemap` → HTML-Ansicht
- `/sitemap.xml` → XML für Suchmaschinen

## Routen-Macros

Für einzelne Routen können Priorität und Änderungsfrequenz direkt in `routes/web.php` gesetzt werden:

```php
Route::get('/startseite', StartseiteController::class)
    ->name('startseite')
    ->priority('1.0')
    ->changefreq('daily');

Route::get('/blog', BlogController::class)
    ->name('blog')
    ->changefreq('weekly');

// Route aus der Sitemap ausschließen
Route::get('/intern', InternController::class)
    ->name('intern')
    ->noIndex();
```

### Verfügbare Macros

| Macro | Beschreibung | Werte |
|---|---|---|
| `->priority('1.0')` | Priorität der Seite | `0.0` – `1.0` |
| `->changefreq('daily')` | Änderungsfrequenz | `always`, `hourly`, `daily`, `weekly`, `monthly`, `yearly`, `never` |
| `->noIndex()` | Route aus Sitemap ausschließen | — |

## Was wird automatisch gefiltert?

Folgende Routen werden grundsätzlich **nicht** in die Sitemap aufgenommen:

- Kein GET-Zugriff (POST, PUT, DELETE etc.)
- Routen mit dynamischen Parametern (`/user/{id}`)
- Routen, die mit `_` beginnen (z.B. `_debugbar`)
- Alle in `config/sitemap.php` konfigurierten Ausschlüsse

## Namespace

`ITHilbert\Sitemap`
