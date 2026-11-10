<?php

namespace App\Filament\Resources\Peminjamen\Pages;

use App\Filament\Resources\Peminjamen\PeminjamanResource;
use App\Models\Buku;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CreatePeminjaman extends CreateRecord
{
    protected static string $resource = PeminjamanResource::class;

    protected function beforeCreate(): void
    {
        foreach ($this->data['detailPeminjamans'] ?? [] as $detail) {
            $buku = Buku::find($detail['buku_id']);

            if (! $buku || $buku->stok < $detail['jumlah']) {
                throw ValidationException::withMessages([
                    'data.detailPeminjamans' =>
                        'Stok buku tidak mencukupi.',
                ]);
            }
        }
    }

    protected function afterCreate(): void
    {
        DB::transaction(function () {
            foreach ($this->record->detailPeminjamans as $detail) {
                Buku::whereKey($detail->buku_id)
                    ->decrement('stok', $detail->jumlah);
            }
        });
    }
}