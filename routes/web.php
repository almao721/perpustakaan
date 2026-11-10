<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Siswa\PeminjamanController;
use App\Http\Controllers\Siswa\RiwayatPeminjamanController;
use App\Models\Buku;
use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth', 'can:siswa'])->group(function () {

    Route::get('/siswa/dashboard', function () {
        return view('siswa.dashboard');
    })->name('siswa.dashboard');

    Route::get('/siswa/buku', function (Request $request) {
        $bukus = Buku::query()
            ->when($request->filled('cari'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('judul', 'like', '%' . $request->cari . '%')
                        ->orWhere('kode_buku', 'like', '%' . $request->cari . '%');
                });
            })
            ->get();

        return view('siswa.buku.index', compact('bukus'));
    })->name('siswa.buku');

    Route::post('/siswa/peminjaman', [PeminjamanController::class, 'store'])
        ->name('siswa.peminjaman');

    Route::get('/siswa/riwayat', [RiwayatPeminjamanController::class, 'index'])
        ->name('siswa.riwayat');

    Route::post('/siswa/peminjaman/{id}/kembali', [RiwayatPeminjamanController::class, 'kembali'])
        ->name('siswa.peminjaman.kembali');
});