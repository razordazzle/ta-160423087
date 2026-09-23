<!-- resources/views/cari-rekomendasi/preferensi.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilihan Preferensi</title>
</head>
<body>
    @extends('layouts.app')

    @section('title','Pilihan Preferensi')

    @section('content')
    <div class="max-w-md mx-auto px-6 pt-6 pb-10">
        {{-- Top bar --}}
        <div class="relative flex items-center">
            <a href="{{ route('cari-rekomendasi.lokasi') }}" class="text-gray-700">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
            </a>
            <span class="absolute inset-x-0 text-center text-xs font-bold tracking-widest uppercase text-gray-500">Preferensi Kriteria</span>
        </div>

        {{-- Header --}}
        <h1 class="mt-6 text-2xl leading-tight font-heading font-bold text-gray-900">Tentukan Preferensi Anda</h1>
        <p class="text-gray-600 text-[15px] mt-2 leading-relaxed">Pilih cara sistem menentukan bobot kriteria untuk rekomendasi Anda</p>

        <form method="POST" action="{{ route('cari-rekomendasi.preferensi.store') }}" class="mt-6 space-y-4">
            @csrf

            <button type="submit" name="pilihan" value="personal" class="w-full text-left flex items-start justify-between gap-4 bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <div class="flex items-start gap-3">
                    <span class="shrink-0 w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                            <path d="M4 6h10M18 6h2M4 12h4M12 12h8M4 18h13"/>
                            <circle cx="16" cy="6" r="2"/>
                            <circle cx="8" cy="12" r="2"/>
                            <circle cx="17" cy="18" r="2"/>
                        </svg>
                    </span>
                    <div>
                        <span class="block font-heading font-bold text-gray-900">Atur Preferensi Sendiri</span>
                        <span class="block text-sm text-gray-500 mt-1 leading-relaxed">Sesuaikan tingkat kepentingan tiap kriteria sesuai prioritas Anda</span>
                    </div>
                </div>
                <span class="shrink-0 w-8 h-8 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                        <path d="m9 6 6 6-6 6"/>
                    </svg>
                </span>
            </button>

            <button type="submit" name="pilihan" value="default" class="w-full text-left flex items-start justify-between gap-4 bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <div class="flex items-start gap-3">
                    <span class="shrink-0 w-10 h-10 rounded-xl bg-secondary/10 text-secondary flex items-center justify-center">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                            <path d="M17 20v-1a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v1"/>
                            <circle cx="10" cy="7" r="3"/>
                            <path d="M21 20v-1a4 4 0 0 0-3-3.87"/>
                            <path d="M15.5 3.5a3 3 0 0 1 0 5.9"/>
                        </svg>
                    </span>
                    <div>
                        <span class="block font-heading font-bold text-gray-900">Gunakan Rekomendasi Umum</span>
                        <span class="block text-sm text-gray-500 mt-1 leading-relaxed">Sistem menggunakan bobot umum berdasarkan preferensi mayoritas wisatawan</span>
                    </div>
                </div>
                <span class="shrink-0 w-8 h-8 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                        <path d="m9 6 6 6-6 6"/>
                    </svg>
                </span>
            </button>
        </form>
    </div>
    @endsection
</body>
</html>