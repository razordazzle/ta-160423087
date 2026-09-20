<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferensi Kriteria</title>
</head>
<body>
    <h1>Preferensi Kriteria</h1>
    <p>Isi 10 nilai perbandingan berpasangan (skala 1-9). Sisi kiri lebih penting: isi angka &gt; 1. Sisi kanan lebih penting: isi pecahan, misal 1/3.</p>

    @if ($errors->any())
        <p style="color:red;">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('cari-rekomendasi.perbandingan.store') }}">
        @csrf
        @php
            $pasangan=[[1,2],[1,3],[1,4],[1,5],[2,3],[2,4],[2,5],[3,4],[3,5],[4,5]];
        @endphp
        @foreach ($pasangan as $i=>[$a,$b])
            <label>{{ $kriteria[$a] }} vs {{ $kriteria[$b] }}:
                <input type="text" name="nilai[{{ $i }}]" placeholder="misal: 3 atau 1/3" required>
            </label><br>
        @endforeach
        <button type="submit">Lanjut</button>
    </form>
</body>
</html>