<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

namespace App\Filament\Resources\WaitlistSignups\Tables;

use App\Models\WaitlistSignup;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Symfony\Component\HttpFoundation\StreamedResponse;

class WaitlistSignupsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('email')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-o-envelope'),

                TextColumn::make('created_at')
                    ->label('Signed up')
                    ->dateTime()
                    ->since()
                    ->sortable(),
            ])
            ->headerActions([
                // Download the whole waitlist as CSV — no export tables needed.
                Action::make('exportCsv')
                    ->label('Export CSV')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(fn (): StreamedResponse => response()->streamDownload(function () {
                        $out = fopen('php://output', 'w');

                        // `escape: ''` is both the RFC-4180 behaviour and what
                        // PHP 9 makes the default; passing it explicitly silences
                        // the 8.4 deprecation and pins the output either way.
                        fputcsv($out, ['email', 'signed_up_at'], escape: '');

                        WaitlistSignup::orderBy('created_at')->chunk(500, function ($rows) use ($out) {
                            foreach ($rows as $row) {
                                fputcsv($out, [$row->email, $row->created_at?->toIso8601String()], escape: '');
                            }
                        });

                        fclose($out);
                    }, 'soundchex-waitlist-'.now()->format('Y-m-d').'.csv')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
