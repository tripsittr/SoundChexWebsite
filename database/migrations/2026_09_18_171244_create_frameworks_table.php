<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * The "Built on" marquee on the credits page — the frameworks/languages
 * SoundChex is built with, editable from the admin panel.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('frameworks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role')->nullable();     // "PHP framework", "iOS, iPadOS & tvOS"
            $table->string('url')->nullable();       // project homepage
            $table->string('color', 9)->default('#d95145'); // brand colour for the tile
            $table->string('logo_slug')->nullable(); // maps to public/images/credits/<slug>.svg (null = monogram)
            $table->string('mono', 8)->nullable();   // monogram fallback text
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('frameworks');
    }
};
