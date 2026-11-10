<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
</head>
<body>
    <h1>Selamat Datang, {{ Auth::user()->name }}!</h1>

    <p>Selamat datang di Perpustakaan Digital Sekolah.</p>

    <h2>Menu Siswa</h2>

    <ul>
        <li><a href="#">Lihat Katalog Buku</a></li>
        <li><a href="#">Riwayat Peminjaman</a></li>
    </ul>

    <form action="{{ url('/logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>