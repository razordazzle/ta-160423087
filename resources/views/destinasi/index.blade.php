<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Destinasi</title>
</head>
<body>
    <h1>Destinasi Wisata di Bali</h1>
    <p>Temukan pesona alam dan budaya yang tak terlupakan.</p>

    <form method="GET" action="{{ route('destinasi.index') }}">
        <input type="text" name="q" placeholder="Cari destinasi..." value="{{  request('q') }}">
        <button type="submit">Cari</button>
    </form>

    <div>
        <a href="{{ route('destinasi.index') }}"><button>Semua</button></a>
        @foreach ($kategoriList as $kategori)
            <a href="{{ route('destinasi.index',['kategori'=>$kategori->id_kategori]) }}"><button>{{ $kategori->nama_kategori }}</button></a>
        @endforeach
    </div>

    @foreach ($destinasiList as $destinasi)
        <div style="border:1px solid #ccc; padding:10px; margin-bottom: 10px;">
            <strong>{{ $destinasi->nama }}</strong><br>
            {{ Str::limit($destinasi->deskripsi,60) }}<br>
            Mulai Rp {{ number_format($destinasi->harga_tiket,0,',','.') }} &middot; Rating {{ $destinasi->rating }}
            <a href="{{ route('destinasi.show',$destinasi) }}">→</a>
        </div>
    @endforeach
</body>
</html>