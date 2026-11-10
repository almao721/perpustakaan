
<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku</title>

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

        .ayam-berkoko {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .tolong {
            margin-bottom: 25px;
        }

        .tolong h1 {
            color: #854b20;
            font-size: 26px;
            margin-bottom: 10px;
        }

        .tolong p {
            color: #777;
            font-size: 14px;
        }

        .helo-alert {
            padding: 13px 18px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .moneymoneymoney {
            background: #e5f4e8;
            color: #28743c;
            border: 1px solid #c5e5cc;
        }

        .spohk {
            background: #fce8e6;
            color: #b42318;
            border: 1px solid #f5c6c2;
        }

        .yanginiyangini {
            background: white;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #e8e5e1;
            margin-bottom: 25px;
            display: flex;
            gap: 10px;
        }

        .yanginiyangini input {
            flex: 1;
            min-width: 0;
            padding: 11px 14px;
            border: 1px solid #ddd;
            border-radius: 7px;
            outline: none;
            font-size: 14px;
        }

        .yanginiyangini input:focus {
            border-color: #e99a52;
        }

        button, .pulangmarilahpulang {
            background: #e99a52;
            color: white;
            border: none;
            padding: 11px 18px;
            border-radius: 7px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        button:hover, .pulangmarilahpulang:hover {
            background: #cf7832;
        }

        .kotak-kotak {
            background: white;
            border-radius: 12px;
            border: 1px solid #e8e5e1;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
        }

        th {
            background: #fff0df;
            color: #854b20;
            padding: 15px;
            text-align: left;
            font-size: 14px;
        }

        td {
            padding: 14px 15px;
            border-top: 1px solid #eee;
            font-size: 14px;
            color: #555;
        }

        tbody tr:hover {
            background: #fffaf5;
        }

        .stok-aman {
            font-weight: bold;
            color: #28743c;
        }

        .habishabishabis {
            color: #b42318;
            font-weight: bold;
        }

        .kokbisaya {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .kokbisaya input {
            width: 65px;
            padding: 9px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        .kokbisaya button {
            padding: 9px 13px;
        }

        .omg {
            text-align: center;
            padding: 25px;
            color: #888;
        }

        .pulangmarilahpulang {
            display: inline-block;
            margin-top: 25px;
            background: #c66b27;
        }

        @media (max-width: 600px) {
            nav {
                padding: 12px 5%;
            }

            .yanginiyangini {
                flex-direction: column;
            }

            .yanginiyangini button {
                width: 100%;
            }

            .tolong h1 {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>

    <nav>
        <h2>Perpustakaan Digital</h2>
        <a href="{{ route('siswa.dashboard') }}" class="pulangmarilahpulang" style="margin: 0;">Dashboard</a>
    </nav>

    <div class="ayam-berkoko">

        <div class="tolong">
            <h1>Katalog Buku</h1>
            <p>Temukan dan pinjam buku yang tersedia di perpustakaan sekolah.</p>
        </div>

        @if (session('success'))
            <div class="helo-alert moneymoneymoney">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="helo-alert spohk">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('siswa.buku') }}" method="GET" class="yanginiyangini">
            <input
                type="text"
                name="cari"
                placeholder="Cari judul atau kode buku..."
                value="{{ request('cari') }}"
            >
            <button type="submit">Cari Buku</button>
        </form>

        <div class="kotak-kotak">
            <table>
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
                            <td>
                                <span class="{{ $buku->stok > 0 ? 'stok-aman' : 'habishabishabis' }}">
                                    {{ $buku->stok }}
                                </span>
                            </td>
                            <td>
                                @if ($buku->stok > 0)
                                    <form action="{{ route('siswa.peminjaman') }}" method="POST" class="kokbisaya">
                                        @csrf

                                        <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                                        <input type="number" name="jumlah" min="1" max="{{ $buku->stok }}" value="1" required>
                                        <button type="submit">Pinjam</button>
                                    </form>
                                @else
                                    <span class="habishabishabis">Stok Habis</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="omg">
                                Buku tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <a href="{{ route('siswa.dashboard') }}" class="pulangmarilahpulang">Kembali ke Dashboard</a>
    </div>
</body>
</html>
