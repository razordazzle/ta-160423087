<!-- resources/views/wishlist/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
</head>
<body>
    @extends('layouts.app')

    @section('title','Wishlist')

    @section('content')
    <div class="max-w-md mx-auto px-6 pt-6 pb-10">
        {{-- Top bar --}}
        <div class="relative flex items-center">
            <a href="{{ route('home') }}" class="text-gray-700">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
            </a>
            <span class="absolute inset-x-0 text-center text-xs font-bold tracking-widest uppercase text-gray-500">Wishlist Saya</span>
        </div>

        @if(session('pesan'))
            <div class="mt-4 flex items-center gap-2 bg-primary/10 text-primary text-sm font-medium rounded-lg px-4 py-3">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 shrink-0">
                    <path d="M20 6 9 17l-5-5"/>
                </svg>
                {{ session('pesan') }}
            </div>
        @endif

        @if ($wishlist->isEmpty())
            <div class="mt-16 flex flex-col items-center text-center px-6">
                <span class="w-16 h-16 rounded-full bg-gray-100 text-gray-300 flex items-center justify-center">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" class="w-8 h-8">
                        <path d="M10 17.5s-6.5-4-8.5-8A4.5 4.5 0 0 1 10 5a4.5 4.5 0 0 1 8.5 4.5c-2 4-8.5 8-8.5 8Z"/>
                    </svg>
                </span>
                <p class="mt-4 font-heading font-bold text-gray-900">Anda belum memiliki wishlist</p>
                <p class="mt-1 text-sm text-gray-500">Destinasi yang Anda simpan akan muncul di sini</p>
            </div>
        @else
            <p class="mt-5 text-primary text-sm font-bold">{{ $wishlist->count() }} destinasi tersimpan</p>

            <div class="mt-4 space-y-3">
                @foreach ($wishlist as $destinasi)
                    <div class="flex items-center gap-3 bg-white rounded-2xl border border-gray-100 shadow-sm p-3">
                        <div class="shrink-0 w-14 h-14 rounded-xl overflow-hidden {{ !$destinasi->gambar ? 'bg-gradient-to-br from-slate-400 to-slate-600 flex items-center justify-center' : '' }}">
                            @if ($destinasi->gambar)
                                <img src="{{ asset('storage/destinasi/' . $destinasi->gambar) }}" alt="{{ $destinasi->nama }}" class="w-full h-full object-cover">
                            @else
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-white/40">
                                    <path d="m3 16 5-6 4 4 3-4 6 8H3Z"/>
                                    <circle cx="8" cy="7" r="2"/>
                                </svg>
                            @endif
                        </div>

                        <div class="flex-1 min-w-0">
                            <p class="font-heading font-bold text-gray-900 truncate">{{ $destinasi->nama }}</p>
                            <p class="text-xs text-primary font-semibold mt-0.5">Mulai Rp {{ number_format($destinasi->harga_tiket,0,',','.') }}</p>
                        </div>

                        <form method="POST" action="{{ route('wishlist.hapus',$destinasi) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="shrink-0 w-10 h-10 rounded-full bg-red-50 text-red-600 flex items-center justify-center">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4.5 h-4.5">
                                    <path d="M4 7h16"/>
                                    <path d="M10 11v6M14 11v6"/>
                                    <path d="M6 7l1 13a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2l1-13"/>
                                    <path d="M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($wishlist->isNotEmpty())
            <a href="{{ route('rekomendasi-rute.index') }}" class="mt-6 flex items-center justify-center gap-2 bg-primary text-white font-bold text-sm uppercase tracking-wide rounded-2xl py-4 shadow-lg shadow-primary/20">
                Lihat Rekomendasi Rute
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                    <path d="M9 4 3 6v14l6-2 6 2 6-2V4l-6 2-6-2Z"/>
                    <path d="M9 4v14M15 6v14"/>
                </svg>
            </a>
        @endif
    </div>
    @endsection
</body>
</html>