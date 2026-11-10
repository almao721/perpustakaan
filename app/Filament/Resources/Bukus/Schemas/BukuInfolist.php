<?php

namespace App\Filament\Resources\Bukus\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BukuInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('kode_buku'),
                TextEntry::make('judul'),
                TextEntry::make('penulis'),
                TextEntry::make('penerbit')
                    ->placeholder('-'),
                TextEntry::make('stok')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
