<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasilitas Prioritas</title>
</head>
<body>
    <h1>Fasilitas prioritas</h1>
    <p>Pilih fasilitas yang penting bagi Anda (opsional). Jika tidak memilih, seluruh fasilitas dianggap sesuai.</p>

    <form method="POST" action="{{ route('cari-rekomendasi.fasilitas.store') }}">
        @csrf
        @foreach ($fasilitas as $f)
            <label>
                <input type="checkbox" name="fasilitas[]" value="{{ $f->id_fasilitas }}">
                {{ $f->nama_fasilitas }}
            </label><br>
        @endforeach
        <button type="submit">Lanjut</button>
    </form>
</body>
</html>