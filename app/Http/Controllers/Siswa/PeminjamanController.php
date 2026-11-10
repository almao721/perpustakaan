<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $anggota = Anggota::where('user_id', Auth::id())->first();

        if (! $anggota) {
            throw ValidationException::withMessages([
                'buku_id' => 'Data anggota tidak ditemukan.',
            ]);
        }

        DB::transaction(function () use ($validated, $anggota) {
            $buku = Buku::whereKey($validated['buku_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($buku->stok < $validated['jumlah']) {
                throw ValidationException::withMessages([
                    'jumlah' => 'Stok buku tidak mencukupi.',
                ]);
            }

            $tanggalPinjam = Carbon::today();

            $peminjaman = Peminjaman::create([
                'anggota_id' => $anggota->id,
                'tanggal_pinjam' => $tanggalPinjam,
                'tanggal_jatuh_tempo' => $tanggalPinjam->copy()->addDays(7),
                'status' => 'dipinjam',
            ]);

            $peminjaman->detailPeminjamans()->create([
                'buku_id' => $buku->id,
                'jumlah' => $validated['jumlah'],
            ]);

            $buku->decrement('stok', $validated['jumlah']);
        });

        return redirect()->route('siswa.buku')
            ->with('success', 'Buku berhasil dipinjam!');
    }
}