
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa</title>

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
            padding: 20px;
        }

        .kotak-login {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 40px 32px;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .judul-login {
            text-align: center;
            color: #f47721;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .teks-login {
            text-align: center;
            color: #777;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .pesan-berhasil {
            background: #e8f8ec;
            color: #258044;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .pesan-error {
            background: #fff0f0;
            color: #c0392b;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .form-login {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .form-login input {
            width: 100%;
            padding: 14px;
            border: 1px solid #ddd;
            border-radius: 9px;
            outline: none;
            font-size: 14px;
        }

        .form-login input:focus {
            border-color: #ff8a35;
        }

        .tombol-masuk {
            background: #ff851b;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 9px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .tombol-masuk:hover {
            background: #e96d0b;
        }

        .teks-daftar {
            text-align: center;
            margin-top: 25px;
            color: #777;
            font-size: 14px;
        }

        .teks-daftar a {
            color: #f47721;
            font-weight: bold;
            text-decoration: none;
        }

        .teks-daftar a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="kotak-login">
        <h1 class="judul-login">Login Siswa</h1>
        <p class="teks-login">Silakan masuk ke akun perpustakaan kamu</p>

        @if (session('success'))
            <div class="pesan-berhasil">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="pesan-error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST" class="form-login">
            @csrf
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="tombol-masuk">Login</button>
        </form>

        <p class="teks-daftar">
            Belum punya akun?
            <a href="{{ url('/register') }}">Daftar di sini</a>
        </p>
    </div>
</body>
</html>
