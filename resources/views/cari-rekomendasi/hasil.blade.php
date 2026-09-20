<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Rekomendasi</title>
</head>
<body>
    <h1>Rekomendasi untuk Anda</h1>
    <p>Diurutkan berdasarkan preferensi Anda</p>

    @foreach ($hasil as $index=>$destinasi)
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
            <strong>#{{ $index+1 }} — {{ $destinasi->nama }}</strong><br>
            Mulai Rp {{ number_format($destinasi->harga_tiket,0,',','.') }}<br>
            Rating: {{ $destinasi->rating }}<br>
            Nilai Preferensi: {{ round($destinasi->pivot->nilai_preferensi,4) }}
        </div>
    @endforeach
</body>
</html>