<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Lokasi Awal</title>
</head>
<body>
    <h1>Di mana lokasi awal Anda?</h1>

    @if($errors->any())
        <p style="color:red;">{{ $errors->first('lokasi_awal') }}</p>
    @endif

    <form method="POST" action="{{ route('cari-rekomendasi.lokasi.store') }}">
        @csrf
        <input type="text" name="lokasi_awal" placeholder="Nama hotel atau penginapan (contoh: Aston Denpasar, The Swell Hotel" value="{{ old('lokasi_awawl') }}" required>
        <button type="submit">Lanjut</button>
    </form>
</body>
</html>