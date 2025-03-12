<?php

return [
    'defaults' => [
        'priority' => '0.5',
        'changefreq' => 'monthly',
    ],

    'exclude' => [
        'exact' => [
            '_ignition/*',
            'sitemap.xml',
            'sitemap',
            'sitemap/*',
            'login',
            'logout',
            'register',
            'privacy',
            'cookie',
            'cookie-richtlinie',
            'cookie-statistik',
            'impressum',
            'datenschutz',
            'kontakt',
            'no-permission',
        ],
        'prefix' => [ // Routen, die mit diesen Präfixen beginnen, werden ausgeschlossen
            'admin', // Schließt ALLE `admin/*` Routen aus
            'password',
            'register',
        ],
        'suffix' => [ // Routen, die mit diesen Suffixen enden, werden ausgeschlossen
            'edit',
            'create',
            'delete'
        ],
    ],
];