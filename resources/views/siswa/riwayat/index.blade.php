<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman</title>
</head>
<body>
    <h1>Riwayat Peminjaman Buku</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif

    @forelse ($peminjamans as $peminjaman)
        <h3>Peminjaman #{{ $peminjaman->id }}</h3>

        <p>Tanggal Pinjam: {{ $peminjaman->tanggal_pinjam }}</p>
        <p>Jatuh Tempo: {{ $peminjaman->tanggal_jatuh_tempo }}</p>
        <p>Status: {{ $peminjaman->status }}</p>

        <table border="1" cellpadding="10">
            <tr>
                <th>Judul Buku</th>
                <th>Jumlah</th>
                <th>Tanggal Kembali</th>
                <th>Aksi</th>
            </tr>

            @foreach ($peminjaman->detailPeminjamans as $detail)
                <tr>
                    <td>{{ $detail->buku->judul }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>{{ $detail->tanggal_kembali ?? '-' }}</td>
                    <td>
                        @if ($detail->tanggal_kembali === null)
                            <form action="{{ route('siswa.peminjaman.kembali', $detail->id) }}" method="POST">
                                @csrf
                                <button type="submit">Kembalikan</button>
                            </form>
                        @else
                            Sudah Dikembalikan
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>

        <hr>
    @empty
        <p>Belum ada riwayat peminjaman.</p>
    @endforelse

    <p><a href="{{ route('siswa.dashboard') }}">Kembali ke Dashboard</a></p>
</body>
</html>