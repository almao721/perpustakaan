
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Siswa</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: #e7e7c2;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 25px 20px;
        }

        .kotak-daftar {
            width: 100%;
            max-width: 450px;
            background: white;
            padding: 35px 32px;
            border-radius: 18px;
            box-shadow: 0 8px 25px #00000014;
        }

        .judul-daftar {
            text-align: center;
            color: #f47721;
            font-size: 27px;
            margin-bottom: 10px;
        }

        .teks-daftar {
            text-align: center;
            color: #777;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .pesan-error {
            background: #fff0f0;
            color: #c0392b;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .form-daftar {
            display: flex;
            flex-direction: column;
            gap: 13px;
        }

        .form-daftar input,
        .form-daftar textarea {
            width: 100%;
            padding: 13px;
            border: 1px solid #ddd;
            border-radius: 9px;
            outline: none;
            font-size: 14px;
            background: white;
        }

        .form-daftar textarea {
            min-height: 85px;
            resize: vertical;
        }

        .form-daftar input:focus,
        .form-daftar textarea:focus {
            border-color: #ff8a35;
        }

        .tombol-daftar {
            background: #ff851b;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 9px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
            margin-top: 5px;
        }

        .tombol-daftar:hover {
            background: #e96d0b;
        }

        .teks-login {
            text-align: center;
            margin-top: 23px;
            color: #777;
            font-size: 14px;
        }

        .teks-login a {
            color: #f47721;
            font-weight: bold;
            text-decoration: none;
        }

        .teks-login a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .kotak-daftar {
                padding: 28px 22px;
            }
        }
    </style>
</head>

<body>
    <div class="kotak-daftar">
        <h1 class="judul-daftar">Daftar Akun Siswa</h1>
        <p class="teks-daftar">Buat akun untuk menggunakan perpustakaan digital</p>

        @if ($errors->any())
            <div class="pesan-error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ url('/register') }}" method="POST" class="form-daftar">
            @csrf

            <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>

            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>

            <input type="text" name="nis" placeholder="NIS" value="{{ old('nis') }}" required>

            <input type="text" name="kelas" placeholder="Kelas" value="{{ old('kelas') }}" required>

            <textarea name="alamat" placeholder="Alamat">{{ old('alamat') }}</textarea>

            <input type="password" name="password" placeholder="Password (minimal 8 karakter)" required>

            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>

            <button type="submit" class="tombol-daftar">Daftar</button>
        </form>

        <p class="teks-login">
            Sudah punya akun?
            <a href="{{ url('/login') }}">Login di sini</a>
        </p>
    </div>
</body>
</html>
