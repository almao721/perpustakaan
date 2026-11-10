<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku</title>
</head>
<body>
    <h1>Katalog Buku Perpustakaan</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('siswa.buku') }}" method="GET">
        <input
            type="text"
            name="cari"
            placeholder="Cari judul atau kode buku..."
            value="{{ request('cari') }}"
        >
        <button type="submit">Cari</button>
    </form>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Buku</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bukus as $buku)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $buku->kode_buku }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ $buku->penerbit }}</td>
                    <td>{{ $buku->stok }}</td>
                    <td>
                        @if ($buku->stok > 0)
                            <form action="{{ route('siswa.peminjaman') }}" method="POST">
                                @csrf

                                <input
                                    type="hidden"
                                    name="buku_id"
                                    value="{{ $buku->id }}"
                                >

                                <input
                                    type="number"
                                    name="jumlah"
                                    min="1"
                                    max="{{ $buku->stok }}"
                                    value="1"
                                    required
                                >

                                <button type="submit">Pinjam</button>
                            </form>
                        @else
                            Stok Habis
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Buku tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p>
        <a href="{{ route('siswa.dashboard') }}">Kembali ke Dashboard</a>
    </p>
</body>
</html>