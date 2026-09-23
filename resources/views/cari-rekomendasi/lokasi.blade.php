<!-- resources/views/cari-rekomendasi/lokasi.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Lokasi Awal</title>
</head>
<body>
    @extends('layouts.app')

    @section('title','Input Lokasi Awal')

    @section('content')
    <div class="max-w-md mx-auto px-6 pt-6 pb-10">
        {{-- Top bar --}}
        <div class="relative flex items-center">
            <a href="{{ route('home') }}" class="text-gray-700">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
            </a>
            <span class="absolute inset-x-0 text-center text-xs font-bold tracking-widest uppercase text-gray-500">Input Lokasi</span>
        </div>

        {{-- Header --}}
        <h1 class="mt-10 text-2xl leading-tight font-heading font-bold text-gray-900 text-center">Cari Destinasi Wisata di Bali</h1>
        <p class="text-secondary text-[15px] mt-3 text-center leading-relaxed">Masukkan lokasi awal Anda<br>(nama hotel atau penginapan)</p>

        @if($errors->any())
            <div class="mt-4 flex items-center gap-2 bg-red-50 text-red-600 text-sm font-medium rounded-lg px-4 py-3">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 shrink-0">
                    <circle cx="12" cy="12" r="9"/>
                    <path d="M12 8v4M12 16h.01"/>
                </svg>
                {{ $errors->first('lokasi_awal') }}
            </div>
        @endif

        <form method="POST" action="{{ route('cari-rekomendasi.lokasi.store') }}" class="mt-6">
            @csrf

            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                        <path d="M12 21s7-7.5 7-12a7 7 0 1 0-14 0c0 4.5 7 12 7 12Z"/>
                        <circle cx="12" cy="9" r="2.5"/>
                    </svg>
                </span>
                <input type="text" name="lokasi_awal" placeholder="Contoh: Ayana Resort Bali" value="{{ old('lokasi_awal') }}" required
                    class="w-full bg-white border border-gray-200 rounded-2xl pl-11 pr-4 py-3.5 text-[15px] text-gray-900 placeholder-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
            </div>

            <button type="submit" class="mt-4 w-full flex items-center justify-center gap-2 bg-primary text-white font-bold text-[15px] rounded-2xl py-4 shadow-lg shadow-primary/20">
                Lanjut
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                    <path d="M5 12h14M13 5l7 7-7 7"/>
                </svg>
            </button>
        </form>
    </div>
    @endsection
</body>
</html>