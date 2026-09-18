<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace Database\Seeders;

use App\Models\Framework;
use App\Models\Platform;
use Illuminate\Database\Seeder;

/**
 * Seeds the editable front-end content — the home platform grid and the credits
 * marquee — so a fresh database matches the site. Idempotent (keyed on name).
 */
class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $platforms = [
            ['macOS', true], ['iOS', true], ['iPadOS', false], ['Windows', false],
            ['Linux', false], ['Android', false], ['Apple TV', false], ['Android TV', false],
            ['Fire TV', false], ['Roku', false], ['Smart TVs', false], ['CarPlay & Auto', false],
        ];
        foreach ($platforms as $i => [$name, $available]) {
            Platform::updateOrCreate(['name' => $name], ['available' => $available, 'sort_order' => $i]);
        }

        // [name, role, url, color, logo_slug, mono]
        $frameworks = [
            ['Laravel', 'PHP framework', 'https://laravel.com', '#FF2D20', 'laravel', 'La'],
            ['PHP', 'The language', 'https://php.net', '#777BB4', 'php', 'php'],
            ['Filament', 'Admin panels', 'https://filamentphp.com', '#FDAE4B', 'filament', 'Fi'],
            ['Livewire', 'Reactive UI', 'https://livewire.laravel.com', '#FB70A9', 'livewire', 'Lw'],
            ['Tailwind CSS', 'Styling', 'https://tailwindcss.com', '#38BDF8', 'tailwindcss', 'Tw'],
            ['Vite', 'Build tool', 'https://vitejs.dev', '#646CFF', 'vite', 'Vt'],
            ['Alpine.js', 'Interactivity', 'https://alpinejs.dev', '#77C1D2', 'alpinedotjs', 'Aj'],
            ['Tauri', 'Desktop shell', 'https://tauri.app', '#FFC131', 'tauri', 'Ta'],
            ['Rust', 'Systems language', 'https://rust-lang.org', '#DEA584', 'rust', 'Rs'],
            ['getID3', 'Media tags', 'https://github.com/JamesHeinrich/getID3', '#4B9CD3', null, 'id3'],
            ['Symfony', 'PHP components', 'https://symfony.com', '#000000', 'symfony', 'Sy'],
            ['SQLite', 'Database', 'https://sqlite.org', '#003B57', 'sqlite', 'Sq'],
            ['Swift', 'iOS, iPadOS & tvOS', 'https://swift.org', '#F05138', 'swift', 'Sw'],
            ['Kotlin', 'Android language', 'https://kotlinlang.org', '#7F52FF', 'kotlin', 'Kt'],
            ['Jetpack Compose', 'Android UI', 'https://developer.android.com/jetpack/compose', '#4285F4', 'jetpackcompose', 'Jc'],
            ['Android', 'Android, TV & Fire TV', 'https://developer.android.com', '#3DDC84', 'android', 'An'],
            ['Roku (BrightScript)', 'Roku app', 'https://developer.roku.com', '#662D91', 'roku', 'Rk'],
        ];
        foreach ($frameworks as $i => [$name, $role, $url, $color, $slug, $mono]) {
            Framework::updateOrCreate(['name' => $name], [
                'role' => $role, 'url' => $url, 'color' => $color,
                'logo_slug' => $slug, 'mono' => $mono, 'sort_order' => $i,
            ]);
        }
    }
}
