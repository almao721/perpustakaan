<?php

namespace App\Filament\Resources\Bukus\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BukuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_buku')
                    ->label('Kode Buku')
                    ->required(),

                TextInput::make('judul')
                    ->label('Judul Buku')
                    ->required(),

                TextInput::make('penulis')
                    ->label('Penulis')
                    ->required(),

                TextInput::make('penerbit')
                    ->label('Penerbit'),

                TextInput::make('stok')
                    ->label('Stok')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->minValue(0),
            ]);
    }
}