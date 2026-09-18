<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * The real date an item was worked on, distinct from created_at/updated_at
 * (which are both "seeded today" for the imported backlog). Backfilled from git
 * history — when the item's ref first appeared in the repos — by
 * `items:date-from-git`, and shown on the public roadmap.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->date('activity_on')->nullable()->after('sort_order');
        });
    }

    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('activity_on');
        });
    }
};
