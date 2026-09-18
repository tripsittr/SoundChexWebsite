<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Filament\Widgets;

use App\Models\Item;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TrackerOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $total = Item::count();
        $roadmap = Item::where('published', true)->count();
        $inProgress = Item::where('status', 'in-progress')->count();
        $planned = Item::where('status', 'planned')->count();
        $done = Item::where('status', 'done')->count();

        return [
            Stat::make('Tracked items', (string) $total)
                ->description('Todos, issues & roadmap entries')
                ->color('primary'),

            Stat::make('On the public roadmap', (string) $roadmap)
                ->description('Published items')
                ->color('success'),

            Stat::make('In progress', (string) $inProgress)
                ->description($planned.' planned · '.$done.' done')
                ->color('warning'),
        ];
    }
}
