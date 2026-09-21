<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekomendasi Rute</title>
</head>
<body>
    <h1>Rekomendasi rute kunjungan</h1>
    <p><strong>Estimasi:</strong> {{ round($hasilRute['total_jarak_km'],1) }} km &bull; {{ round($hasilRute['total_durasi_menit']) }} menit</p>
    <h2>Rute Perjalanan</h2>
    @foreach ($hasilRute['urutan'] as $index=>$item)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <strong>Urutan {{ $index+1 }} — {{ $item['destinasi']->nama }}</strong>
            @if($item['jarak_dari_sebelumnya_km'] !== null)
                {{ round($item['jarak_dari_sebelumnya_km'],1) }} km dari {{ $index === 0 ? 'Lokasi Awal' : 'stop sebelumnya' }}
            @endif
        </div>
    @endforeach
</body>
</html>