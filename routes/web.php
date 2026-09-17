<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/download', 'download')->name('download');
Route::view('/roadmap', 'roadmap')->name('roadmap');
Route::redirect('/privacy', '/legal/website-privacy')->name('privacy');
Route::redirect('/terms', '/legal/website-terms')->name('terms');

Route::view('/legal', 'legal-index')->name('legal');
Route::get('/legal/{slug}', function (string $slug) {
    abort_unless(view()->exists("legal.{$slug}"), 404);

    return view("legal.{$slug}");
})->where('slug', '[a-z0-9-]+')->name('legal.show');

Route::view('/docs', 'docs-index')->name('docs');
Route::get('/docs/{slug}', function (string $slug) {
    abort_unless(view()->exists("docs.{$slug}"), 404);

    return view("docs.{$slug}");
})->where('slug', '[a-z0-9-]+')->name('docs.show');
