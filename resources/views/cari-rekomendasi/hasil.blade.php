<!-- resources/views/cari-rekomendasi/hasil.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Rekomendasi</title>
    <style>
        .peta-label {
            background: #fff;
            border: none;
            border-radius: 9999px;
            padding: 4px 10px;
            font-weight: 600;
            font-size: 12px;
            color: #334155;
            box-shadow: 0 1px 4px rgba(0,0,0,.15);
        }
        .peta-label::before { display: none; }
    </style>
</head>
<body>
    @extends('layouts.app')

    @section('title','Hasil Rekomendasi')

    @section('content')
    @php
        $jarakKm = function ($lat1, $lon1, $lat2, $lon2) {
            $R = 6371;
            $dLat = deg2rad($lat2 - $lat1);
            $dLon = deg2rad($lon2 - $lon1);
            $a = sin($dLat / 2) ** 2 + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) ** 2;
            return $R * 2 * atan2(sqrt($a), sqrt(1 - $a));
        };
    @endphp

    <div class="max-w-md mx-auto px-6 pt-6 pb-10">
        {{-- Top bar --}}
        <div class="relative flex items-center">
            <a href="{{ route('home') }}" class="text-gray-700">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
            </a>
            <span class="absolute inset-x-0 text-center text-xs font-bold tracking-widest uppercase text-gray-500">Hasil Rekomendasi</span>
        </div>

        {{-- Header --}}
        <h1 class="mt-6 text-2xl leading-tight font-heading font-bold text-gray-900">Hasil Rekomendasi</h1>
        <p class="text-secondary text-[15px] mt-2">Ditemukan {{ $hasil->count() }} destinasi terbaik untuk Anda.</p>

        {{-- Map --}}
        <div id="peta-hasil" class="mt-4 h-56 w-full rounded-2xl overflow-hidden border border-gray-100 bg-gray-100"></div>

        {{-- Cards --}}
        <div class="mt-4">
            @foreach ($hasil as $index=>$destinasi)
                @php
                    $jarak=$jarakKm($pencarian->latitude_awal,$pencarian->longitude_awal,$destinasi->latitude,$destinasi->longitude);
                    $sudahWishlist=in_array($destinasi->id_destinasi,$idWishlist);
                @endphp
                <div id="dest-{{ $destinasi->id_destinasi }}" class="scroll-mt-4 mt-4 bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                    <div class="relative h-40 w-full {{ !$destinasi->gambar ? 'bg-gradient-to-br from-slate-400 to-slate-600' : '' }}">
                        @if ($destinasi->gambar)
                            <img src="{{ asset('storage/destinasi/' . $destinasi->gambar) }}" alt="{{ $destinasi->nama }}" class="absolute inset-0 h-full w-full object-cover">
                        @endif

                        <form method="POST" action="{{ route('wishlist.toggle',$destinasi) }}" class="absolute top-3 right-3">
                            @csrf
                            <button type="submit" class="w-9 h-9 rounded-full bg-white/90 flex items-center justify-center shadow-sm {{ $sudahWishlist ? 'text-red-500' : 'text-gray-600' }}" aria-label="{{ $sudahWishlist ? 'Hapus dari wishlist' : 'Tambah ke wishlist' }}">
                                <svg viewBox="0 0 20 20" fill="{{ $sudahWishlist ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4.5 h-4.5">
                                    <path d="M10 17.5s-6.5-4-8.5-8A4.5 4.5 0 0 1 10 5a4.5 4.5 0 0 1 8.5 4.5c-2 4-8.5 8-8.5 8Z"/>
                                </svg>
                            </button>
                        </form>

                        <span class="absolute -bottom-4 left-4 w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-heading font-bold text-sm border-4 border-white shadow">#{{ $index+1 }}</span>
                    </div>

                    <div class="pt-6 px-4 pb-4">
                        <h3 class="font-heading font-bold text-lg text-gray-900">{{ $destinasi->nama }}</h3>

                        <div class="grid grid-cols-2 gap-2 mt-3">
                            <div class="flex items-center gap-1.5 bg-slate-100 rounded-lg px-3 py-2 text-sm font-semibold text-gray-700">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-primary shrink-0">
                                    <rect x="3" y="6" width="18" height="12" rx="2"/>
                                    <path d="M3 10h18"/>
                                </svg>
                                {{ $destinasi->harga_tiket > 0 ? 'Rp '.number_format($destinasi->harga_tiket,0,',','.') : 'Rp 0 (Gratis)' }}
                            </div>

                            <div class="flex items-center gap-1.5 bg-slate-100 rounded-lg px-3 py-2 text-sm font-semibold text-gray-700">
                                <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-amber-400 shrink-0">
                                    <path d="M10 1.5l2.6 5.6 6.2.6-4.6 4.2 1.3 6.1L10 14.9l-5.5 3.1 1.3-6.1L1.2 7.7l6.2-.6L10 1.5z"/>
                                </svg>
                                {{ $destinasi->rating }}
                            </div>

                            <div class="flex items-center gap-1.5 bg-slate-100 rounded-lg px-3 py-2 text-sm font-semibold text-gray-700">
                                @if ($jarak < 2)
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-secondary shrink-0">
                                        <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"/>
                                        <path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"/>
                                    </svg>
                                @else
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-secondary shrink-0">
                                        <path d="M5 11l1.5-4.5A2 2 0 0 1 8.4 5h7.2a2 2 0 0 1 1.9 1.5L19 11"/>
                                        <rect x="3" y="11" width="18" height="6" rx="2"/>
                                        <circle cx="7.5" cy="17.5" r="1.5"/>
                                        <circle cx="16.5" cy="17.5" r="1.5"/>
                                    </svg>
                                @endif
                                {{ round($jarak,1) }} km
                            </div>

                            <div class="flex items-center gap-1.5 bg-slate-100 rounded-lg px-3 py-2 text-sm font-semibold text-gray-700">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-primary shrink-0">
                                    <path d="m3 17 6-6 4 4 8-8"/>
                                    <path d="M15 7h6v6"/>
                                </svg>
                                Nilai {{ round($destinasi->pivot->nilai_preferensi*100) }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var lokasiAwal = @json(['lat' => $pencarian->latitude_awal, 'lng' => $pencarian->longitude_awal]);
            var destinasiList = @json($hasil->map(fn($d) => ['nama' => $d->nama, 'lat' => $d->latitude, 'lng' => $d->longitude])->values());

            var map = L.map('peta-hasil');
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(map);

            function buatPin(warna) {
                return L.divIcon({
                    className: '',
                    html: '<svg width="28" height="36" viewBox="0 0 28 36" xmlns="http://www.w3.org/2000/svg"><path d="M14 0C6.3 0 0 6.3 0 14c0 10.5 14 22 14 22s14-11.5 14-22C28 6.3 21.7 0 14 0Z" style="fill:' + warna + '"/><circle cx="14" cy="14" r="5.5" fill="white"/></svg>',
                    iconSize: [28, 36],
                    iconAnchor: [14, 36]
                });
            }

            var warnaPrimary = getComputedStyle(document.documentElement).getPropertyValue('--color-primary').trim();
            var warnaSecondary = getComputedStyle(document.documentElement).getPropertyValue('--color-secondary').trim();

            var titik = [[lokasiAwal.lat, lokasiAwal.lng]];

            L.marker([lokasiAwal.lat, lokasiAwal.lng], { icon: buatPin(warnaSecondary) })
                .addTo(map)
                .bindTooltip('Lokasi Anda', { permanent: true, direction: 'right', offset: [4, -18], className: 'peta-label' });

            destinasiList.forEach(function (d) {
                L.marker([d.lat, d.lng], { icon: buatPin(warnaPrimary) }).addTo(map).bindTooltip(d.nama, { direction: 'top' });
                titik.push([d.lat, d.lng]);
            });

            map.fitBounds(titik, { padding: [30, 30] });
        });
    </script>
    @endsection
</body>
</html>