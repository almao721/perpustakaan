<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Siswa</title>
</head>
<body>
    <h1>Daftar Akun Siswa</h1>

    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ url('/register') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>

        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
        
        <input type="text" name="nis" placeholder="NIS" value="{{ old('nis') }}" required>
        
        <input type="text" name="kelas" placeholder="Kelas" value="{{ old('kelas') }}" required>
        
        <textarea name="alamat" placeholder="Alamat">{{ old('alamat') }}</textarea>
        
        <input type="password" name="password" placeholder="Password (minimal 8 karakter)" required>
        
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
        
        <button type="submit">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="{{ url('/login') }}">Login di sini</a></p>
</body>
</html>