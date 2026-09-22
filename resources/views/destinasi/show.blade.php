<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $destinasi->nama }}</title>
</head>
<body>
    <a href="{{ route('destinasi.index') }}">&larr; Kembali</a>

    <h1>{{ $destinasi->nama }}</h1>
    <p>{{ $destinasi->deskripsi }}</p>

    @if (session('pesan'))
        <p style="color:green;">{{ session('pesan') }}</p>
    @endif

    <p>
        <strong>Harga Tiket:</strong> Rp {{ number_format($destinasi->harga_tiket,0,',','.') }}<br>
        <strong>Rating:</strong> {{ $destinasi->rating }} / 5<br>
        <strong>Popularitas:</strong> {{ $destinasi->popularitas }}<br>
        <strong>Kategori:</strong> {{ $destinasi->kategori->pluck('nama_kategori')->join(', ') }}<br>
        <strong>Fasilitas:</strong> {{ $destinasi->fasilitas->pluck('nama_fasilitas')->join(', ') }}
    </p>

    <form method="POST" action="{{ route('wishlist.tambah', $destinasi) }}">
        @csrf
        <button type="submit">+ Tambah ke Wishlist</button>
    </form>
</body>
</html>