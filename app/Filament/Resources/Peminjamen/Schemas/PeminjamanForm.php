<?php

namespace App\Filament\Resources\Peminjamen\Schemas;

use App\Models\Anggota;
use App\Models\Buku;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PeminjamanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('anggota_id')
                ->label('Nama Anggota')
                ->options(Anggota::query()->pluck('nama', 'id'))
                ->searchable()
                ->required(),

            DatePicker::make('tanggal_pinjam')
                ->label('Tanggal Pinjam')
                ->required()
                ->default(now()),

            DatePicker::make('tanggal_jatuh_tempo')
                ->label('Tanggal Jatuh Tempo')
                ->required()
                ->minDate(now()),

            Repeater::make('detailPeminjamans')
                ->label('Daftar Buku')
                ->relationship()
                ->schema([
                    Select::make('buku_id')
                        ->label('Pilih Buku')
                        ->options(
                            Buku::query()
                                ->where('stok', '>', 0)
                                ->pluck('judul', 'id')
                        )
                        ->searchable()
                        ->required(),

                    TextInput::make('jumlah')
                        ->label('Jumlah Buku')
                        ->numeric()
                        ->default(1)
                        ->minValue(1)
                        ->required(),
                ])
                ->columns(2)
                ->minItems(1)
                ->required(),
        ]);
    }
}