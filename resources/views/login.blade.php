<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Masuk ke akun</h1>
    <p>Masuk untuk mengakses preferensi dan wishlist yang telah tersimpan di akun Anda</p>

    @if ($errors->any())
        <p style="color:red;">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('login.store') }}">
        @csrf
        <input type="email" name="email" placeholder="nama@email.com" value="{{ old('email') }}" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Masuk</button>
    </form>

    <p>Belum punya akun? <a href="{{ route('registrasi.form') }}">Daftar</a></p>
</body>
</html>