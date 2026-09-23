<!-- resources/views/destinasi/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Destinasi</title>
</head>
<body>
    @extends('layouts.app')

    @section('title','Daftar Destinasi')

    @section('content')
    <div class="max-w-md mx-auto px-6 pt-6 pb-10">
        {{-- Top bar --}}
        <div class="relative flex items-center">
            <a href="{{ route('home') }}" class="text-gray-700">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
            </a>
            <span class="absolute inset-x-0 text-center text-xs font-bold tracking-widest uppercase text-gray-500">Daftar Destinasi</span>
        </div>

        {{-- Header --}}
        <h1 class="mt-5 text-[26px] leading-tight font-heading font-bold text-gray-900">Destinasi Wisata di Bali</h1>
        <p class="text-gray-600 text-[15px] mt-2">Temukan pesona alam dan budaya yang tak terlupakan.</p>

        {{-- Search --}}
        <form method="GET" action="{{ route('destinasi.index') }}" class="mt-6 flex items-center gap-3 bg-slate-100 rounded-xl px-4 py-3.5">
            <button type="submit" class="text-gray-400 shrink-0" aria-label="Cari">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                    <circle cx="11" cy="11" r="7"/>
                    <path d="m21 21-4.3-4.3"/>
                </svg>
            </button>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari destinasi..." class="flex-1 bg-transparent text-[15px] text-gray-900 placeholder-gray-400 focus:outline-none">
        </form>

        {{-- Category filter --}}
        <div class="mt-4 flex items-center gap-2 overflow-x-auto whitespace-nowrap pb-1">
            <a href="{{ route('destinasi.index') }}" class="px-4 py-2 rounded-full text-sm font-semibold border shrink-0 {{ !request('kategori') ? 'bg-primary text-white border-primary' : 'bg-white text-gray-600 border-gray-200' }}">Semua</a>
            @foreach ($kategoriList as $kategori)
                <a href="{{ route('destinasi.index',['kategori'=>$kategori->id_kategori]) }}" class="px-4 py-2 rounded-full text-sm font-semibold border shrink-0 {{ (string) request('kategori') === (string) $kategori->id_kategori ? 'bg-primary text-white border-primary' : 'bg-white text-gray-600 border-gray-200' }}">{{ $kategori->nama_kategori }}</a>
            @endforeach
        </div>

        {{-- Destination cards --}}
        <div class="mt-6 space-y-4">
            @foreach ($destinasiList as $destinasi)
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                    <div class="relative h-48 w-full {{ !$destinasi->gambar ? 'bg-gradient-to-br from-slate-400 to-slate-600 flex items-center justify-center' : '' }}">
                        @if ($destinasi->gambar)
                            <img src="{{ asset('storage/destinasi/' . $destinasi->gambar) }}" alt="{{ $destinasi->nama }}" class="absolute inset-0 h-full w-full object-cover">
                        @else
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-10 h-10 text-white/40">
                                <path d="m3 16 5-6 4 4 3-4 6 8H3Z"/>
                                <circle cx="8" cy="7" r="2"/>
                            </svg>
                        @endif

                        <span class="absolute top-3 left-3 flex items-center gap-1 bg-white/95 rounded-full px-2.5 py-1 text-xs font-bold text-gray-900 shadow-sm">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5 text-amber-400">
                                <path d="M10 1.5l2.6 5.6 6.2.6-4.6 4.2 1.3 6.1L10 14.9l-5.5 3.1 1.3-6.1L1.2 7.7l6.2-.6L10 1.5z"/>
                            </svg>
                            {{ $destinasi->rating }}
                        </span>

                        <span class="absolute top-3 right-3 flex items-center gap-1 bg-red-600/90 rounded-full px-2.5 py-1 text-xs font-bold text-white shadow-sm">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5">
                                <path d="M10 1c1 3-3 4-3 7a3 3 0 0 0 6 0c1 1 2 2.5 2 4.5A5 5 0 0 1 5 12.5C5 8 8 5 10 1z"/>
                            </svg>
                            {{ $destinasi->popularitas }}
                        </span>
                    </div>

                    <div class="p-4">
                        <h3 class="font-heading font-bold text-gray-900">{{ $destinasi->nama }}</h3>
                        <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $destinasi->deskripsi }}</p>

                        <div class="mt-3 flex items-end justify-between">
                            <div>
                                <span class="block text-[11px] font-medium tracking-wide uppercase text-gray-400">Tiket Masuk</span>
                                <span class="block font-heading font-bold text-primary mt-0.5">Mulai Rp {{ number_format($destinasi->harga_tiket,0,',','.') }}</span>
                            </div>
                            <a href="{{ route('destinasi.show', $destinasi) }}" class="shrink-0 w-10 h-10 rounded-full bg-secondary text-white flex items-center justify-center">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                                    <path d="M5 12h14M13 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endsection
</body>
</html>