<!-- resources/views/rekomendasi-rute/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekomendasi Rute</title>
</head>
<body>
    @extends('layouts.app')

    @section('title','Rekomendasi Rute')

    @section('content')
    @php
        $paletKelas = [
            ['dot' => 'bg-primary', 'pill' => 'bg-primary/10 text-primary'],
            ['dot' => 'bg-secondary', 'pill' => 'bg-secondary/10 text-secondary'],
            ['dot' => 'bg-amber-500', 'pill' => 'bg-amber-50 text-amber-600'],
        ];
    @endphp

    <div class="max-w-md mx-auto px-6 pt-6 pb-10">
        {{-- Top bar --}}
        <div class="relative flex items-center">
            <a href="{{ route('wishlist.index') }}" class="text-gray-700">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
            </a>
            <span class="absolute inset-x-0 text-center text-xs font-bold tracking-widest uppercase text-gray-500">Rekomendasi Rute</span>
        </div>

        {{-- Map --}}
        <div id="peta-rute" class="mt-4 h-56 w-full rounded-2xl overflow-hidden border border-gray-100 bg-gray-100"></div>

        {{-- Estimasi --}}
        <div class="mt-4 flex items-center gap-3 bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
            <span class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center shrink-0">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                    <path d="M5 11l1.5-4.5A2 2 0 0 1 8.4 5h7.2a2 2 0 0 1 1.9 1.5L19 11"/>
                    <rect x="3" y="11" width="18" height="6" rx="2"/>
                    <circle cx="7.5" cy="17.5" r="1.5"/>
                    <circle cx="16.5" cy="17.5" r="1.5"/>
                </svg>
            </span>
            <div>
                <span class="block text-[11px] font-bold tracking-wide uppercase text-gray-400">Estimasi</span>
                <span class="block font-heading font-bold text-lg text-gray-900">{{ round($hasilRute['total_jarak_km'],1) }} km &bull; {{ round($hasilRute['total_durasi_menit']) }} mnt</span>
            </div>
        </div>

        {{-- Rute Perjalanan --}}
        <h2 class="mt-6 font-heading font-bold text-lg text-gray-900">Rute Perjalanan</h2>

        <div class="mt-4">
            @foreach ($hasilRute['urutan'] as $index=>$item)
                @php $warna = $paletKelas[$index % 3]; @endphp
                <div class="flex gap-3">
                    <div class="flex flex-col items-center">
                        <span class="w-3 h-3 rounded-full {{ $warna['dot'] }} mt-2 shrink-0"></span>
                        @if(!$loop->last)
                            <span class="flex-1 w-px bg-gray-200 my-1"></span>
                        @endif
                    </div>
                    <div class="flex-1 bg-white rounded-2xl border border-gray-100 shadow-sm p-4 mb-4">
                        <span class="inline-block text-[11px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-full {{ $warna['pill'] }}">Urutan {{ $index+1 }}</span>
                        <p class="font-heading font-bold text-gray-900 mt-1.5">{{ $item['destinasi']->nama }}</p>
                        @if($item['jarak_dari_sebelumnya_km'] !== null)
                            <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5 shrink-0">
                                    <path d="M12 21s7-7.5 7-12a7 7 0 1 0-14 0c0 4.5 7 12 7 12Z"/>
                                    <circle cx="12" cy="9" r="2.5"/>
                                </svg>
                                {{ round($item['jarak_dari_sebelumnya_km'],1) }} km dari {{ $index === 0 ? 'Lokasi Awal' : 'stop sebelumnya' }}
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var lokasiAwal = @json(['lat' => $lokasiAwal['latitude'], 'lng' => $lokasiAwal['longitude']]);
            var urutan = @json(collect($hasilRute['urutan'])->map(fn($item) => [
                'nama' => $item['destinasi']->nama,
                'lat' => $item['destinasi']->latitude,
                'lng' => $item['destinasi']->longitude
            ])->values());
            var geometri = @json($hasilRute['geometri_rute']);

            var map = L.map('peta-rute');
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(map);

            var palet = [
                getComputedStyle(document.documentElement).getPropertyValue('--color-primary').trim(),
                getComputedStyle(document.documentElement).getPropertyValue('--color-secondary').trim(),
                '#D97706'
            ];

            function buatPinNomor(nomor, warna) {
                return L.divIcon({
                    className: '',
                    html: '<div style="width:28px;height:28px;border-radius:9999px;background:' + warna + ';border:3px solid #fff;box-shadow:0 1px 4px rgba(0,0,0,.25);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:12px;">' + nomor + '</div>',
                    iconSize: [28, 28],
                    iconAnchor: [14, 14]
                });
            }

            function buatPinAwal() {
                var warna = getComputedStyle(document.documentElement).getPropertyValue('--color-secondary').trim();
                return L.divIcon({
                    className: '',
                    html: '<div style="width:18px;height:18px;border-radius:9999px;background:' + warna + ';border:3px solid #fff;box-shadow:0 0 0 3px ' + warna + '55;"></div>',
                    iconSize: [18, 18],
                    iconAnchor: [9, 9]
                });
            }

            var titik = [[lokasiAwal.lat, lokasiAwal.lng]];
            L.marker([lokasiAwal.lat, lokasiAwal.lng], { icon: buatPinAwal() }).addTo(map);

            urutan.forEach(function (item, index) {
                var warna = palet[index % palet.length];
                L.marker([item.lat, item.lng], { icon: buatPinNomor(index + 1, warna) }).addTo(map).bindTooltip(item.nama, { direction: 'top' });
                titik.push([item.lat, item.lng]);
            });

            if (geometri.length > 0) {
                L.polyline(geometri, {
                    color: getComputedStyle(document.documentElement).getPropertyValue('--color-primary').trim(),
                    weight: 4,
                    opacity: 0.85,
                    dashArray: '1, 10',
                    lineCap: 'round'
                }).addTo(map);
                map.fitBounds(geometri, { padding: [30, 30] });
            } else {
                map.fitBounds(titik, { padding: [30, 30] });
            }
        });
    </script>
    @endsection
</body>
</html>