
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: #eeeee8;
            color: #333;
        }

        .almapunya {
            background: #c66b27;
            padding: 18px 8%;
            color: white;
        }

        .almapunya h2 {
            font-size: 21px;
        }

        .riwayatmu {
            width: 90%;
            max-width: 1100px;
            margin: 35px auto;
        }

        .bonjour {
            color: #d96c1c;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .soferyferygood {
            color: #777;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .berhasil-dong {
            background: #e8f8ec;
            color: #258044;
            padding: 13px;
            border-radius: 9px;
            margin-bottom: 15px;
        }

        .waduh-error {
            background: #fff0f0;
            color: #c0392b;
            padding: 13px;
            border-radius: 9px;
            margin-bottom: 15px;
        }

        .pijam {
            background: white;
            padding: 24px;
            border-radius: 13px;
            margin-bottom: 22px;
            border: 1px solid #eee;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        }

        .almapunya-judul {
            color: #d96c1c;
            font-size: 19px;
            margin-bottom: 17px;
        }

        .info-kamu {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #555;
        }

        .masih-dipinjam {
            color: #d97706;
            background: #fff3df;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .sudah-aman {
            color: #258044;
            background: #e8f8ec;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .meja-kamu {
            width: 100%;
            overflow-x: auto;
        }

        .tabel-alma {
            width: 100%;
            border-collapse: collapse;
            min-width: 550px;
        }

        .tabel-alma th {
            background: #fff0df;
            color: #a65317;
            padding: 13px;
            text-align: left;
            font-size: 13px;
        }

        .tabel-alma td {
            padding: 14px 13px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .balikin-dong {
            background: #ff851b;
            color: white;
            border: none;
            padding: 9px 15px;
            border-radius: 7px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.2s;
        }

        .balikin-dong:hover {
            background: #e96d0b;
        }

        .good-job {
            color: #258044;
            font-size: 13px;
            font-weight: bold;
        }

        .bonjour-banget {
            background: white;
            padding: 35px;
            border-radius: 13px;
            text-align: center;
            color: #888;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        }

        .pulang-dulu {
            display: inline-block;
            margin-top: 25px;
            background: #c66b27;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 14px;
            transition: 0.2s;
        }

        .pulang-dulu:hover {
            background: #a65317;
        }

        @media (max-width: 600px) {
            .riwayatmu {
                width: 94%;
                margin-top: 25px;
            }

            .pijam {
                padding: 17px;
            }

            .bonjour {
                font-size: 24px;
            }

            .info-kamu {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="almapunya">
        <h2>Perpustakaan Digital Sekolah</h2>
    </div>

    <div class="riwayatmu">
        <h1 class="bonjour">Riwayat Peminjaman Buku</h1>
        <p class="soferyferygood">Lihat daftar buku yang pernah kamu pinjam.</p>

        @if (session('success'))
            <div class="berhasil-dong">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="waduh-error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @forelse ($peminjamans as $peminjaman)
            <div class="pijam">
                <h3 class="almapunya-judul">
                    Peminjaman #{{ $peminjaman->id }}
                </h3>

                <div class="info-kamu">
                    <p>
                        Tanggal Pinjam:
                        {{ $peminjaman->tanggal_pinjam }}
                    </p>

                    <p>
                        Jatuh Tempo:
                        {{ $peminjaman->tanggal_jatuh_tempo }}
                    </p>

                    <p>
                        Status:
                        @if ($peminjaman->status === 'dikembalikan')
                            <span class="sudah-aman">Dikembalikan</span>
                        @else
                            <span class="masih-dipinjam">Dipinjam</span>
                        @endif
                    </p>
                </div>

                <div class="meja-kamu">
                    <table class="tabel-alma">
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
                                            <button type="submit" class="balikin-dong">
                                                Kembalikan
                                            </button>
                                        </form>
                                    @else
                                        <span class="good-job">
                                            Sudah Dikembalikan
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        @empty
            <div class="bonjour-banget">
                Belum ada riwayat peminjaman.
            </div>
        @endforelse

        <a href="{{ route('siswa.dashboard') }}" class="pulang-dulu">
            Kembali ke Dashboard
        </a>
    </div>
</body>
</html>
