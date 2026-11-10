
<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #eeeee8;
            color: #333;
        }

        nav {
            background: #c66b27;
            padding: 14px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #f3e5d5;
        }

        nav h2 {
            font-size: 19px;
            color: #f9f9f9;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .welcome {
            background: #fff0df;
            padding: 38px;
            border-radius: 14px;
            border-left: 5px solid #e99a52;
            margin-bottom: 32px;
        }

        .welcome h1 {
            font-size: 27px;
            color: #854b20;
            margin-bottom: 12px;
        }

        .welcome p {
            font-size: 15px;
            line-height: 1.7;
            color: #765d49;
        }

        .section-title {
            margin-bottom: 18px;
            font-size: 21px;
            color: #444;
        }

        .menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 27px;
            border-radius: 12px;
            border: 1px solid #e8e5e1;
            border-top: 3px solid #e99a52;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 5px 15px #0000000f;
        }

        .card h3 {
            color: #854b20;
            margin-bottom: 12px;
            font-size: 18px;
        }

        .card p {
            color: #777;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .card a {
            display: inline-block;
            background: #e99a52;
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: bold;
            transition: 0.3s;
        }

        .card a:hover {
            background: #cf7832;
        }

        .logout {
            background: #fff0df;
            color: #b96527;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .logout:hover {
            background: #fbe2c8;
        }

        @media (max-width: 600px) {
            nav {
                padding: 12px 5%;
            }

            .welcome {
                padding: 27px 22px;
            }

            .welcome h1 {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>

    <nav>
        <h2>Perpustakaan Digital</h2>

        <form action="{{ url('/logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout">Logout</button>
        </form>
    </nav>

    <div class="container">

        <div class="welcome">
            <h1>Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p>Selamat datang di Perpustakaan Digital Sekolah.</p>
            <p>Temukan buku favoritmu dan mulai membaca hari ini.</p>
        </div>

        <h2 class="section-title">Menu Siswa</h2>
        <div class="menu">
            <div class="card">
                <h3>Katalog Buku</h3>
                <p>Lihat berbagai koleksi buku yang tersedia di perpustakaan sekolah.</p>
                <a href="{{ route('siswa.buku') }}">Lihat Buku</a>
            </div>

            <div class="card">
                <h3>Riwayat Peminjaman</h3>
                <p>Lihat daftar buku yang pernah kamu pinjam dan status pengembaliannya.</p>
                <a href="{{ route('siswa.riwayat') }}">Lihat Riwayat</a>
            </div>

        </div>
    </div>
</body>
</html>
