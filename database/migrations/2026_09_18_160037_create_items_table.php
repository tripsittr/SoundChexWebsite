<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * One table for every tracked thing: todos, issues, and public roadmap entries.
 *
 * They share a shape by design, so promoting a todo/issue to the public roadmap
 * is just flipping `published` — no copying, no format mismatch. This table is
 * intended to become the single source of truth for project tracking across all
 * SoundChex repos, replacing the per-repo Markdown Issues docs.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->longText('description')->nullable();

            // Which client/area this belongs to (drives roadmap grouping and the
            // home platform grid). Kept as a string so new platforms don't need a
            // migration; the app validates against a known set.
            $table->string('platform')->index();       // server-desktop, ios, android, tv, roku, web, scnet, integrations, meta

            // Where the work lives / originated.
            $table->string('repo')->nullable()->index(); // SoundChex, SoundChexiOS, SoundChexAndroid, SoundChexTV, SoundChexRoku, SoundChexWebsite

            $table->string('type')->default('todo')->index();   // feature | bug | todo | chore
            $table->string('status')->default('planned')->index(); // planned | in-progress | available | done | deferred
            $table->string('priority')->default('normal');       // low | normal | high | critical

            // Public roadmap flag. A row is internal (a todo/issue) until this is
            // true, at which point it appears on the public /roadmap.
            $table->boolean('published')->default(false)->index();

            // Original reference id from the Markdown trackers (S-151, IOS-21,
            // W-29, A-10…), so nothing is lost when the docs are retired.
            $table->string('ref')->nullable()->index();

            // Short public-facing blurb for the roadmap card (falls back to a
            // trimmed description when empty).
            $table->text('public_summary')->nullable();

            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
