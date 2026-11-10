<?php

namespace App\Filament\Resources\Anggotas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AnggotaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nis')
                    ->label('NIS')
                    ->required()
                    ->unique(ignoreRecord: true),

                TextInput::make('nama')
                    ->label('Nama Anggota')
                    ->required(),

                TextInput::make('kelas')
                    ->label('Kelas')
                    ->required(),

                Textarea::make('alamat')
                    ->label('Alamat')
                    ->columnSpanFull(),
            ]);
    }
}