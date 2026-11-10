<?php

namespace App\Filament\Resources\Peminjamen\Pages;

use App\Filament\Resources\Peminjamen\PeminjamanResource;
use App\Models\Buku;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;

class EditPeminjaman extends EditRecord
{
    protected static string $resource = PeminjamanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('kembalikan')
                ->label('Kembalikan Buku')
                ->color('success')
                ->icon('heroicon-o-check-circle')
                ->visible(fn () => $this->record->status === 'dipinjam')
                ->requiresConfirmation()
                ->action(function () {
                    DB::transaction(function () {
                        $peminjaman = $this->record;

                        if ($peminjaman->status !== 'dipinjam') {
                            return;
                        }

                        foreach ($peminjaman->detailPeminjamans as $detail) {
                            $buku = Buku::whereKey($detail->buku_id)
                                ->lockForUpdate()
                                ->firstOrFail();

                            $buku->increment('stok', $detail->jumlah);

                            $detail->update([
                                'tanggal_kembali' => now()->toDateString(),
                            ]);
                        }

                        $peminjaman->update([
                            'status' => 'dikembalikan',
                        ]);
                    });

                    $this->record->refresh();

                    Notification::make()
                        ->title('Buku berhasil dikembalikan!')
                        ->success()
                        ->send();
                }),

            ViewAction::make(),

            DeleteAction::make()
                ->visible(fn () => $this->record->status === 'dikembalikan'),
        ];
    }
}