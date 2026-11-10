<?php

namespace App\Filament\Widgets;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatistikPerpustakaan extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Buku', Buku::count())
                ->description('Jumlah seluruh buku')
                ->icon('heroicon-o-book-open'),

            Stat::make('Total Anggota', Anggota::count())
                ->description('Jumlah anggota perpustakaan')
                ->icon('heroicon-o-users'),

            Stat::make('Total Peminjaman', Peminjaman::count())
                ->description('Seluruh transaksi peminjaman')
                ->icon('heroicon-o-clipboard-document-list'),

            Stat::make(
                'Sedang Dipinjam',
                Peminjaman::where('status', 'dipinjam')->count()
            )
                ->description('Transaksi belum dikembalikan')
                ->icon('heroicon-o-clock'),
        ];
    }
}