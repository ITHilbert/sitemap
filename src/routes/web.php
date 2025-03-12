<?php

use Illuminate\Support\Facades\Route;
use ITHilbert\Sitemap\SitemapGenerator;

Route::get('/sitemap.xml', function () {
    return response()->view('sitemap', ['routes' => SitemapGenerator::generate()])
        ->header('Content-Type', 'application/xml');
});