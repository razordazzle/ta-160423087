<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
</head>
<body>
    <h1>Buat akun baru</h1>
    <p>Daftar untuk menyimpan wishlist dan preferensi Anda</p>

    @if ($errors->any())
        <p style="color:red;">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('registrasi.store') }}">
        @csrf
        <input type="email" name="email" placeholder="nama@email.com" value="{{ old('email') }}" required><br>
        <input type="password" name="password" placeholder="Password (min. 8 karakter)" required><br>
        <input type="password" name="password_confirmation" placeholder="Ulangi password" required><br>
        <button type="submit">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="{{ route('login.form') }}">Masuk</a></p>
</body>
</html>