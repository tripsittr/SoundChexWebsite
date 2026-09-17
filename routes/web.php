<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/download', 'download')->name('download');
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/terms', 'terms')->name('terms');

Route::view('/docs', 'docs-index')->name('docs');
Route::get('/docs/{slug}', function (string $slug) {
    abort_unless(view()->exists("docs.{$slug}"), 404);

    return view("docs.{$slug}");
})->where('slug', '[a-z0-9-]+')->name('docs.show');
