<!-- resources/views/destinasi/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $destinasi->nama }}</title>
</head>
<body>
    @extends('layouts.app')

    @section('title', $destinasi->nama)

    @section('content')
    <div class="max-w-md mx-auto pb-10">
        {{-- Top bar --}}
        <div class="relative flex items-center px-6 pt-6">
            <a href="{{ route('destinasi.index') }}" class="text-gray-700">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
            </a>
            <span class="absolute inset-x-0 text-center text-xs font-bold tracking-widest uppercase text-gray-500">Detail Destinasi</span>
        </div>

        {{-- Hero image --}}
        <div class="mt-4 relative h-72 w-full {{ !$destinasi->gambar ? 'bg-gradient-to-br from-slate-400 to-slate-600 flex items-center justify-center' : '' }}">
            @if ($destinasi->gambar)
                <img src="{{ asset('storage/destinasi/' . $destinasi->gambar) }}" alt="{{ $destinasi->nama }}" class="absolute inset-0 h-full w-full object-cover">
            @else
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-12 h-12 text-white/40">
                    <path d="m3 16 5-6 4 4 3-4 6 8H3Z"/>
                    <circle cx="8" cy="7" r="2"/>
                </svg>
            @endif
        </div>

        <div class="px-6">
            {{-- Name & location --}}
            <h1 class="mt-5 text-[32px] leading-tight font-heading font-extrabold text-gray-900">{{ $destinasi->nama }}</h1>
            <div class="mt-1 flex items-center gap-1 text-gray-500 text-sm">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                    <path d="M12 21s7-7.5 7-12a7 7 0 1 0-14 0c0 4.5 7 12 7 12Z"/>
                    <circle cx="12" cy="9" r="2.5"/>
                </svg>
                Bali, Indonesia
            </div>

            @if (session('pesan'))
                <div class="mt-4 flex items-center gap-2 bg-primary/10 text-primary text-sm font-medium rounded-lg px-4 py-3">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 shrink-0">
                        <path d="M20 6 9 17l-5-5"/>
                    </svg>
                    {{ session('pesan') }}
                </div>
            @endif

            {{-- Info grid --}}
            <div class="mt-6 grid grid-cols-2 gap-3">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
                    <div class="flex items-center gap-1.5 text-primary">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                            <rect x="3" y="6" width="18" height="12" rx="2"/>
                            <path d="M3 10h18"/>
                            <path d="M7 15h4"/>
                        </svg>
                        <span class="text-[11px] font-bold tracking-wide uppercase">Harga Tiket</span>
                    </div>
                    <p class="mt-2 font-heading font-bold text-lg text-gray-900">Rp {{ number_format($destinasi->harga_tiket,0,',','.') }}</p>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
                    <div class="flex items-center gap-1.5 text-amber-500">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                            <path d="M10 1.5l2.6 5.6 6.2.6-4.6 4.2 1.3 6.1L10 14.9l-5.5 3.1 1.3-6.1L1.2 7.7l6.2-.6L10 1.5z"/>
                        </svg>
                        <span class="text-[11px] font-bold tracking-wide uppercase">Rating</span>
                    </div>
                    <p class="mt-2 font-heading font-bold text-lg text-gray-900">{{ $destinasi->rating }} <span class="text-sm font-medium text-gray-400">/ 5</span></p>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
                    <div class="flex items-center gap-1.5 text-red-600">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                            <path d="M10 1c1 3-3 4-3 7a3 3 0 0 0 6 0c1 1 2 2.5 2 4.5A5 5 0 0 1 5 12.5C5 8 8 5 10 1z"/>
                        </svg>
                        <span class="text-[11px] font-bold tracking-wide uppercase">Popularitas</span>
                    </div>
                    <p class="mt-2 font-heading font-bold text-lg text-gray-900">{{ $destinasi->popularitas }} <span class="text-sm font-medium text-gray-400">Score</span></p>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
                    <div class="flex items-center gap-1.5 text-secondary">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                            <rect x="3" y="7" width="18" height="13" rx="2"/>
                            <path d="M8 7V5a4 4 0 0 1 8 0v2"/>
                        </svg>
                        <span class="text-[11px] font-bold tracking-wide uppercase">Fasilitas</span>
                    </div>
                    <div class="mt-2 flex flex-wrap gap-1.5">
                        @forelse ($destinasi->fasilitas as $fasilitas)
                            <span class="bg-slate-100 text-gray-700 text-xs font-medium rounded-full px-2.5 py-1">{{ $fasilitas->nama_fasilitas }}</span>
                        @empty
                            <span class="text-xs text-gray-400">Belum ada data</span>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Description --}}
            <h2 class="mt-6 font-heading font-bold text-xl text-gray-900">Deskripsi</h2>
            <p class="mt-3 text-gray-600 text-[15px] leading-relaxed">{{ $destinasi->deskripsi }}</p>

            {{-- Wishlist --}}
            <form method="POST" action="{{ route('wishlist.tambah', $destinasi) }}" class="mt-8">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-primary text-white font-bold text-[15px] rounded-full py-4">
                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path d="M10 17.5s-6.5-4-8.5-8A4.5 4.5 0 0 1 10 5a4.5 4.5 0 0 1 8.5 4.5c-2 4-8.5 8-8.5 8Z"/>
                    </svg>
                    Tambah ke Wishlist
                </button>
            </form>
        </div>
    </div>
    @endsection
</body>
</html>