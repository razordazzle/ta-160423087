<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilihan Preferensi</title>
</head>
<body>
    <h1>Tentukan preferensi Anda</h1>
    <p>Pilih cara sistem menentukan bobot kriteria untuk rekomendasi Anda</p>

    <form method="POST" action="{{ route('cari-rekomendasi.preferensi.store') }}">
        @csrf
        <button type="submit" name="pilihan" value="personal">
            Atur Preferensi Sendiri<br>
            <small>Sesuaikan tingkat kepentingan tiap kriteria sesuai prioritas Anda</small>
        </button>
        <br><br>
        <button type="submit" name="pilihan" value="default">
            Gunakan Rekomendasi Umum<br>
            <small>Sistem menggunakan bobot umum berdasarkan preferensi mayoritas wisatawan</small>
        </button>
    </form>
</body>
</html>