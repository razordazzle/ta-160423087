<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
</head>
<body>
    <h1>Wishlist saya</h1>
    <p>{{ $wishlist->count() }} destinasi tersimpan</p>

    @if(session('pesan'))
        <p style="color:green;">{{ session('pesan') }}</p>
    @endif

    @foreach ($wishlist as $destinasi)
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
            <strong>{{ $destinasi->nama }}</strong> — Mulai Rp {{ number_format($destinasi->harga_tiket,0,',','.') }}
            <form method="POST" action="{{ route('wishlist.hapus',$destinasi) }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </div>
    @endforeach

    @if ($wishlist->isNotEmpty())
        <a href="{{ route('rekomendasi-rute.index') }}"><button>Lihat Rekomendasi Rute</button></a>
    @endif
</body>
</html>