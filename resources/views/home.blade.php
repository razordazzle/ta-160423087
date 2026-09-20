<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Destinasi Wisata di Bali</h1>
    <p>Temukan pesona alam dan budaya yang tak terlupakan.</p>

    <input type="text" placeholder="Cari destinasi..." disabled>

    <div style="border:1px solid #ccc; padding:10px; margin:10px 0;">
        <strong>Cari Rekomendasi Personal</strong><br>
        Dapatkan urutan destinasi sesuai preferensi dan lokasi Anda<br>
        <a href="{{ route('cari-rekomendasi.lokasi') }}">Mulai</a>
    </div>

    <h2>Destinasi Populer</h2>
    @foreach ($destinasiPopuler as $destinasi)
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
            <strong>{{ $destinasi->nama }}</strong><br>
            Mulai Rp {{ number_format($destinasi->harga_tiket,0,',','.') }}<br>
            Rating: {{ $destinasi->rating }} · Popularitas: {{ $destinasi->popularitas }}
        </div>
    @endforeach

    <p><em>Lihat semua destinasi → (segera hadir)</em></p>
</body>
</html>