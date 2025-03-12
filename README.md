# Laravel Sitemap Generator

## ✨ Features
- Dynamische Generierung einer `sitemap.xml` aus Laravel-Routen
- Unterstützung für `priority()`, `changefreq()` und `noIndex()` direkt in den Routen
- Konfigurierbare Ausschlüsse:
  - Routen mit `{...}` Platzhaltern
  - Routen, die mit `_` beginnen
  - Routen mit bestimmten **Präfixen** (z. B. `admin/*`)
  - Routen mit bestimmten **Suffixen** (z. B. `*/edit`, `*/create`)
  - Exakte Ausschlüsse aus `config/sitemap.php`
- Unterstützung für **nur GET & ANY Routen**

---

## 🛠 Installation

### **1. Package via Composer installieren**
Füge dein Package als lokale Abhängigkeit hinzu:

```sh
composer require ithilbert/sitemap
```

Falls es sich um ein privates Repository handelt:
```json
"repositories": [
    {
        "type": "vcs",
        "url": "git@github.com:ithilbert/sitemap.git"
    }
]
```

### **2. Service Provider registrieren (falls nicht automatisch erkannt)**

Füge in `config/app.php` unter `providers` hinzu:

```php
ITHilbert\Sitemap\SitemapServiceProvider::class,
```

### **3. Konfiguration veröffentlichen**

```sh
php artisan vendor:publish --tag=config
```

Dies erstellt die Datei `config/sitemap.php`, die du nach Bedarf anpassen kannst.

---

## 🔧 Konfiguration
Die Konfigurationsdatei `config/sitemap.php` erlaubt es, Standardwerte und Ausschlüsse zu definieren:

```php
return [
    'defaults' => [
        'priority' => '0.5',
        'changefreq' => 'weekly',
    ],
    'exclude' => [
        'exact' => [
            '_debugbar/*',
            '_ignition/*',
            'admin/permissions',
        ],
        'prefix' => [ // Ausschluss von allen "admin/*"-Routen
            'admin',
            'dashboard',
        ],
        'suffix' => [ // Ausschluss von "*/edit", "*/create"
            'edit',
            'create',
            'delete'
        ],
    ],
];
```

---

## ✅ Nutzung

### **1. Sitemap.xml **

Es wird automatisch die Route 'sitemap.xml' zur Anwendung hinzugefügt.

### **2. Routen mit Metadaten definieren**

```php
Route::get('/', function () {
    return view('home');
})->name('home')->priority('1.0')->changefreq('daily');

Route::get('/about', function () {
    return view('about');
})->name('about')->priority('0.8')->changefreq('monthly');

Route::get('/admin/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->noIndex(); // Diese Route erscheint nicht in der Sitemap
```

---

## 🔬 Regeln der Sitemap-Generierung
- **Nur GET & ANY Routen** werden in die Sitemap aufgenommen.
- **Routen mit `{...}`** (Platzhalter wie `{id}`) werden ausgeschlossen.
- **Routen, die mit `_` beginnen**, werden ausgeschlossen.
- **Konfigurierbare Ausschlüsse:**
  - Präfix-Filter: (`admin/*`, `dashboard/*`)
  - Suffix-Filter: (`*/edit`, `*/create`, `*/delete`)
  - Exakte Pfade aus `config/sitemap.php`

---

## 📝 Beispiel-Sitemap-Ausgabe
Ein Beispiel für eine generierte `sitemap.xml`:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>http://your-domain.com/</loc>
        <lastmod>2025-03-12T14:21:27+00:00</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>http://your-domain.com/about</loc>
        <lastmod>2025-03-12T14:21:27+00:00</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
</urlset>
```

---

## ⚙ Entwicklung & Tests

### **Tests ausführen**
Falls du PHPUnit nutzt, kannst du Tests mit folgendem Befehl ausführen:

```sh
php artisan test
```

Oder direkt mit PHPUnit:

```sh
vendor/bin/phpunit
```

### **Debugging**
Falls du Fehler analysieren willst, kannst du den Debug-Modus in `.env` aktivieren:

```ini
APP_DEBUG=true
```

---

## 💪 Mitwirken
Pull Requests sind willkommen! Falls du ein Problem findest oder eine Verbesserung vorschlagen möchtest, erstelle einfach ein Issue oder eine PR.

---

## 🎉 Lizenz
Dieses Package ist unter der **MIT-Lizenz** veröffentlicht. Siehe die `LICENSE`-Datei für weitere Details.

---

**📊 Bleib auf dem Laufenden!** Falls du Fragen oder Feedback hast, erstelle ein Issue oder kontaktiere uns. 🚀

