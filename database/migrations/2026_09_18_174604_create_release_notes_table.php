<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Public changelog entries, editable from the admin panel and shown on
 * /changelog. One row per release (or notable update).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('release_notes', function (Blueprint $table) {
            $table->id();
            $table->string('version')->nullable();   // "0.4.1", or blank for a dateless note
            $table->string('title');
            $table->string('platform')->nullable();   // which app/area this release is for (optional)
            $table->longText('body');                  // markdown
            $table->date('released_on')->nullable();
            $table->boolean('published')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('release_notes');
    }
};
