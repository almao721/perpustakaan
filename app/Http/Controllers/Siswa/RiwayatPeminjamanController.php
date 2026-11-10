<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\DetailPeminjaman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class RiwayatPeminjamanController extends Controller
{
    public function index()
    {
        $anggota = Anggota::where('user_id', Auth::id())->firstOrFail();

        $peminjamans = $anggota->peminjamans()
            ->with('detailPeminjamans.buku')
            ->latest()
            ->get();

        return view('siswa.riwayat.index', compact('peminjamans'));
    }

    public function kembali($id)
    {
        $anggota = Anggota::where('user_id', Auth::id())->firstOrFail();

        DB::transaction(function () use ($id, $anggota) {
            $detail = DetailPeminjaman::with('peminjaman')
                ->whereHas('peminjaman', function ($query) use ($anggota) {
                    $query->where('anggota_id', $anggota->id);
                })
                ->lockForUpdate()
                ->findOrFail($id);

            if ($detail->tanggal_kembali !== null) {
                throw ValidationException::withMessages([
                    'buku' => 'Buku ini sudah dikembalikan.',
                ]);
            }

            $detail->buku()->increment('stok', $detail->jumlah);

            $detail->update([
                'tanggal_kembali' => Carbon::today(),
            ]);

            $peminjaman = $detail->peminjaman;

            if (! $peminjaman->detailPeminjamans()->whereNull('tanggal_kembali')->exists()) {
                $peminjaman->update([
                    'status' => 'dikembalikan',
                ]);
            }
        });

        return redirect()->route('siswa.riwayat')
            ->with('success', 'Buku berhasil dikembalikan!');
    }
}