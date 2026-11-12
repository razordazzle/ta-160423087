    @extends('layouts.app')

    @section('title', $destinasi->nama)

    @section('content')
        <div class="max-w-md mx-auto pb-10">
            {{-- Top bar --}}
            <div class="relative flex items-center px-6 pt-6">
                <a href="{{ $asal }}" class="relative z-10 text-gray-700">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="w-5 h-5">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                </a>
                <span
                    class="absolute inset-x-0 text-center text-xs font-bold tracking-widest uppercase text-gray-500">Detail
                    Destinasi</span>
                @include('partials.tombol-wishlist')
            </div>

            {{-- Hero image --}}
            <div
                class="mt-4 relative h-72 w-full {{ !$destinasi->gambar ? 'bg-gradient-to-br from-slate-400 to-slate-600 flex items-center justify-center' : '' }}">
                @if ($destinasi->gambar)
                    <img src="{{ asset('storage/destinasi/' . $destinasi->gambar) }}" alt="{{ $destinasi->nama }}"
                        class="absolute inset-0 h-full w-full object-cover">
                @else
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" class="w-12 h-12 text-white/40">
                        <path d="m3 16 5-6 4 4 3-4 6 8H3Z" />
                        <circle cx="8" cy="7" r="2" />
                    </svg>
                @endif
            </div>

            <div class="px-6">
                {{-- Name & location --}}
                <h1 class="mt-5 text-[32px] leading-tight font-heading font-extrabold text-gray-900">{{ $destinasi->nama }}
                </h1>
                <div class="mt-1 flex items-center gap-1 text-gray-500 text-sm">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="w-4 h-4">
                        <path d="M12 21s7-7.5 7-12a7 7 0 1 0-14 0c0 4.5 7 12 7 12Z" />
                        <circle cx="12" cy="9" r="2.5" />
                    </svg>
                    Bali, Indonesia
                </div>

                <div id="pesan-wishlist" @if (!session('pesan')) hidden @endif
                    class="mt-4 flex items-center gap-2 bg-primary/10 text-primary text-sm font-medium rounded-lg px-4 py-3">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="w-4 h-4 shrink-0">
                        <path d="M20 6 9 17l-5-5" />
                    </svg>
                    <span id="pesan-wishlist-teks">{{ session('pesan') }}</span>
                </div>

                {{-- Info grid --}}
                <div class="mt-6 grid grid-cols-2 gap-3">
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
                        <div class="flex items-center gap-1.5 text-primary">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                                <rect x="3" y="6" width="18" height="12" rx="2" />
                                <path d="M3 10h18" />
                                <path d="M7 15h4" />
                            </svg>
                            <span class="text-[11px] font-bold tracking-wide uppercase">Harga Tiket</span>
                        </div>
                        <p class="mt-2 font-heading font-bold text-lg text-gray-900">Rp
                            {{ number_format($destinasi->harga_tiket, 0, ',', '.') }}</p>
                    </div>

                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
                        <div class="flex items-center gap-1.5 text-amber-500">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                <path
                                    d="M10 1.5l2.6 5.6 6.2.6-4.6 4.2 1.3 6.1L10 14.9l-5.5 3.1 1.3-6.1L1.2 7.7l6.2-.6L10 1.5z" />
                            </svg>
                            <span class="text-[11px] font-bold tracking-wide uppercase">Rating</span>
                        </div>
                        <p class="mt-2 font-heading font-bold text-lg text-gray-900">{{ $destinasi->rating }} <span
                                class="text-sm font-medium text-gray-400">/ 5</span></p>
                    </div>

                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
                        <div class="flex items-center gap-1.5 text-red-600">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                <path
                                    d="M10.9 0.5C11.2 3.7 16.8 6.4 16.8 12.3C16.8 16 13.9 19.2 10 19.2C6.1 19.2 3.2 16.3 3.2 12.6C3.2 9.6 4.2 7 5.4 4.9C5.9 7.2 6.9 8.9 8.2 9.9C7.6 6.3 10.2 4 10.9 0.5ZM10.9 9.4C10.5 11.4 8 12.3 8 14.5C8 15.9 9 16.9 10.2 16.9C11.5 16.9 12.5 16 12.5 14.4C12.5 12.7 11.4 11.3 10.9 9.4Z" />
                            </svg>
                            <span class="text-[11px] font-bold tracking-wide uppercase">Popularitas</span>
                        </div>
                        <p class="mt-2 font-heading font-bold text-lg text-gray-900">{{ $destinasi->popularitas_singkat }}
                            <span class="text-sm font-medium text-gray-400">Score</span></p>
                    </div>

                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
                        <div class="flex items-center gap-1.5 text-secondary">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                                <rect x="3" y="7" width="18" height="13" rx="2" />
                                <path d="M8 7V5a4 4 0 0 1 8 0v2" />
                            </svg>
                            <span class="text-[11px] font-bold tracking-wide uppercase">Fasilitas</span>
                        </div>
                        <div class="mt-2 flex flex-wrap gap-1.5">
                            @forelse ($destinasi->fasilitas as $fasilitas)
                                <span
                                    class="bg-slate-100 text-gray-700 text-xs font-medium rounded-full px-2.5 py-1">{{ $fasilitas->nama_fasilitas }}</span>
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
                <form method="POST" action="{{ route('wishlist.toggle', $destinasi) }}" class="mt-8" data-wishlist-detail>
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 font-bold text-[15px] rounded-2xl py-4 transition-colors {{ $sudahWishlist ? 'bg-red-50 text-red-600' : 'bg-primary text-white' }}">
                        <span data-tampil="tersimpan" @if (!$sudahWishlist) hidden @endif class="flex items-center gap-2">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="w-5 h-5">
                                <path d="M4 7h16" />
                                <path d="M10 11v6M14 11v6" />
                                <path d="M6 7l1 13a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2l1-13" />
                                <path d="M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3" />
                            </svg>
                            Hapus dari Wishlist
                        </span>
                        <span data-tampil="belum" @if ($sudahWishlist) hidden @endif class="flex items-center gap-2">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path d="M10 17.5s-6.5-4-8.5-8A4.5 4.5 0 0 1 10 5a4.5 4.5 0 0 1 8.5 4.5c-2 4-8.5 8-8.5 8Z" />
                            </svg>
                            Tambah ke Wishlist
                        </span>
                    </button>
                </form>
            </div>
        </div>

    <script>
        // tombol wishlist di detail destinasi: simpan atau hapus tanpa memuat ulang halaman
        (function () {
            var form = document.querySelector('form[data-wishlist-detail]');
            if (!form) return;
            var tombol = form.querySelector('button');

            form.addEventListener('submit', function (e) {
                e.preventDefault();
                if (tombol.disabled) return;
                tombol.disabled = true;

                fetch(form.action, {
                    method: 'POST',
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                    body: new FormData(form)
                })
                    .then(function (res) {
                        if (!res.ok) throw new Error('gagal');
                        return res.json();
                    })
                    .then(function (data) {
                        ['bg-red-50', 'text-red-600'].forEach(function (k) { tombol.classList.toggle(k, data.tersimpan); });
                        ['bg-primary', 'text-white'].forEach(function (k) { tombol.classList.toggle(k, !data.tersimpan); });
                        tombol.querySelector('[data-tampil="tersimpan"]').hidden = !data.tersimpan;
                        tombol.querySelector('[data-tampil="belum"]').hidden = data.tersimpan;

                        document.getElementById('pesan-wishlist-teks').textContent = data.pesan;
                        document.getElementById('pesan-wishlist').hidden = false;

                        var badge = document.getElementById('badge-wishlist');
                        if (badge) {
                            badge.textContent = data.jumlah;
                            badge.hidden = data.jumlah === 0;
                        }
                    })
                    .catch(function () {
                        form.submit(); // cadangan: kirim biasa (dengan reload) bila permintaan gagal
                    })
                    .finally(function () {
                        tombol.disabled = false;
                    });
            });
        })();
    </script>
    @endsection
