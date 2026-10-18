<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Saya</title>
</head>
<body>
    @extends('layouts.app')

    @section('title','Akun Saya')

    @section('content')
    @php $tabRiwayat = $tab === 'riwayat'; @endphp

    <div class="max-w-md mx-auto px-6 pt-6 pb-10">
        {{-- Top bar --}}
        <div class="relative flex items-center">
            <a href="{{ route('home') }}" class="relative z-10 text-gray-700">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
            </a>
            <span class="absolute inset-x-0 text-center text-xs font-bold tracking-widest uppercase text-gray-500">Akun Saya</span>
        </div>

        {{-- Tabs --}}
        <div role="tablist" class="mt-6 flex border-b border-gray-200">
            <button type="button" role="tab" id="tab-akun" data-tab="akun" aria-controls="panel-akun" aria-selected="{{ $tabRiwayat ? 'false' : 'true' }}"
                class="flex-1 text-center py-3 text-sm font-semibold border-b-2 -mb-px {{ $tabRiwayat ? 'border-transparent text-gray-500' : 'border-primary text-primary' }}">
                Data Akun
            </button>
            <button type="button" role="tab" id="tab-riwayat" data-tab="riwayat" aria-controls="panel-riwayat" aria-selected="{{ $tabRiwayat ? 'true' : 'false' }}"
                class="flex-1 text-center py-3 text-sm font-semibold border-b-2 -mb-px {{ $tabRiwayat ? 'border-primary text-primary' : 'border-transparent text-gray-500' }}">
                Riwayat
            </button>
        </div>

        {{-- Panel: Data Akun --}}
        <div role="tabpanel" id="panel-akun" aria-labelledby="tab-akun" class="{{ $tabRiwayat ? 'hidden' : '' }}">
            @if ($sudahLogin)
                @if (session('pesan'))
                    <div class="mt-4 flex items-center gap-2 bg-primary/10 text-primary text-sm font-medium rounded-lg px-4 py-3">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 shrink-0">
                            <path d="M20 6 9 17l-5-5"/>
                        </svg>
                        {{ session('pesan') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mt-4 flex items-center gap-2 bg-red-50 text-red-600 text-sm font-medium rounded-lg px-4 py-3">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 shrink-0">
                            <circle cx="12" cy="12" r="9"/>
                            <path d="M12 8v4M12 16h.01"/>
                        </svg>
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('akun.update') }}" class="mt-6">
                    @csrf
                    @method('PUT')

                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                    <input id="email" type="email" name="email" placeholder="nama@email.com" value="{{ old('email',$user->email) }}" required
                        class="w-full bg-white border border-gray-200 rounded-2xl px-4 py-3.5 text-[15px] text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">

                    <label for="password_lama" class="block text-sm font-semibold text-gray-700 mb-1.5 mt-5">Password saat ini</label>
                    <div class="relative">
                        <input id="password_lama" type="password" name="password_lama" placeholder="Password saat ini" required
                            class="w-full bg-white border border-gray-200 rounded-2xl px-4 py-3.5 pr-12 text-[15px] text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                        <button type="button" onclick="togglePassword('password_lama', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400" aria-label="Tampilkan password">
                            <svg data-eye-open viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg data-eye-closed class="hidden w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 3l18 18"/>
                                <path d="M10.6 10.6a3 3 0 0 0 4.24 4.24"/>
                                <path d="M9.88 4.24A10.94 10.94 0 0 1 12 4c6.5 0 10 7 10 7a13.2 13.2 0 0 1-3.06 3.94M6.6 6.6C4.2 8.2 2 12 2 12s2.5 5.5 8 6.9"/>
                            </svg>
                        </button>
                    </div>

                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5 mt-5">Password baru</label>
                    <div class="relative">
                        <input id="password" type="password" name="password" placeholder="Kosongkan jika tidak diubah"
                            class="w-full bg-white border border-gray-200 rounded-2xl px-4 py-3.5 pr-12 text-[15px] text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                        <button type="button" onclick="togglePassword('password', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400" aria-label="Tampilkan password">
                            <svg data-eye-open viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg data-eye-closed class="hidden w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 3l18 18"/>
                                <path d="M10.6 10.6a3 3 0 0 0 4.24 4.24"/>
                                <path d="M9.88 4.24A10.94 10.94 0 0 1 12 4c6.5 0 10 7 10 7a13.2 13.2 0 0 1-3.06 3.94M6.6 6.6C4.2 8.2 2 12 2 12s2.5 5.5 8 6.9"/>
                            </svg>
                        </button>
                    </div>

                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1.5 mt-5">Konfirmasi password baru</label>
                    <div class="relative">
                        <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Ulangi password baru"
                            class="w-full bg-white border border-gray-200 rounded-2xl px-4 py-3.5 pr-12 text-[15px] text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                        <button type="button" onclick="togglePassword('password_confirmation', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400" aria-label="Tampilkan password">
                            <svg data-eye-open viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg data-eye-closed class="hidden w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 3l18 18"/>
                                <path d="M10.6 10.6a3 3 0 0 0 4.24 4.24"/>
                                <path d="M9.88 4.24A10.94 10.94 0 0 1 12 4c6.5 0 10 7 10 7a13.2 13.2 0 0 1-3.06 3.94M6.6 6.6C4.2 8.2 2 12 2 12s2.5 5.5 8 6.9"/>
                            </svg>
                        </button>
                    </div>

                    <button type="submit" class="mt-8 w-full bg-primary text-white font-bold text-[15px] rounded-full py-4 shadow-lg shadow-primary/20">Simpan Perubahan</button>
                </form>
            @else
                <div class="mt-6 bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                    <p class="font-heading font-bold text-gray-900">Anda masih menggunakan akun tamu</p>
                    <p class="mt-1 text-sm text-gray-500 leading-relaxed">Registrasi atau login diperlukan untuk mengelola data akun Anda.</p>

                    <div class="mt-5 space-y-3">
                        <a href="{{ route('registrasi.form') }}" class="block w-full text-center bg-primary text-white font-bold text-[15px] rounded-full py-3.5 shadow-lg shadow-primary/20">Registrasi</a>
                        <a href="{{ route('login.form') }}" class="block w-full text-center bg-white text-primary border border-primary font-bold text-[15px] rounded-full py-3.5">Login</a>
                    </div>
                </div>
            @endif
        </div>

        {{-- Panel: Riwayat --}}
        <div role="tabpanel" id="panel-riwayat" aria-labelledby="tab-riwayat" class="{{ $tabRiwayat ? '' : 'hidden' }}">
            @if ($riwayat->isEmpty())
                <div class="mt-16 flex flex-col items-center text-center px-6">
                    <span class="w-16 h-16 rounded-full bg-gray-100 text-gray-300 flex items-center justify-center">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8">
                            <circle cx="12" cy="12" r="9"/>
                            <path d="M12 7v5l3 2"/>
                        </svg>
                    </span>
                    <p class="mt-4 font-heading font-bold text-gray-900">Belum ada riwayat pencarian</p>
                    <p class="mt-1 text-sm text-gray-500">Hasil rekomendasi yang pernah Anda cari akan muncul di sini</p>
                </div>
            @else
                <p class="mt-5 text-primary text-sm font-bold">{{ $riwayat->count() }} pencarian terakhir</p>

                <div class="mt-4 space-y-3">
                    @foreach ($riwayat as $p)
                        <a href="{{ route('akun.riwayat.buka',$p->id_pencarian) }}" class="flex items-center gap-3 bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
                            <div class="flex-1 min-w-0">
                                <p class="font-heading font-bold text-gray-900 truncate">{{ $p->lokasi_awal }}</p>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $p->waktu_pencarian->format('d/m/Y H:i') }}</p>
                                @if ($p->teratas)
                                    <p class="text-xs text-primary font-semibold mt-1">Peringkat 1: {{ $p->teratas->nama }}</p>
                                @endif
                            </div>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-gray-400 shrink-0">
                                <path d="m9 6 6 6-6 6"/>
                            </svg>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <script>
        function togglePassword(id, btn) {
            const input = document.getElementById(id);
            const open = btn.querySelector('[data-eye-open]');
            const closed = btn.querySelector('[data-eye-closed]');
            if (input.type === 'password') {
                input.type = 'text';
                open.classList.add('hidden');
                closed.classList.remove('hidden');
            } else {
                input.type = 'password';
                closed.classList.add('hidden');
                open.classList.remove('hidden');
            }
        }

        (function () {
            var tabs = document.querySelectorAll('[data-tab]');
            var kelasAktif = ['border-primary', 'text-primary'];
            var kelasNonaktif = ['border-transparent', 'text-gray-500'];

            function pilihTab(nama) {
                tabs.forEach(function (t) {
                    var aktif = t.dataset.tab === nama;
                    t.setAttribute('aria-selected', aktif ? 'true' : 'false');
                    kelasAktif.forEach(function (c) { t.classList.toggle(c, aktif); });
                    kelasNonaktif.forEach(function (c) { t.classList.toggle(c, !aktif); });
                    document.getElementById('panel-' + t.dataset.tab).classList.toggle('hidden', !aktif);
                });
            }

            tabs.forEach(function (t) {
                t.addEventListener('click', function () {
                    pilihTab(t.dataset.tab);
                    history.replaceState(null, '', '?tab=' + t.dataset.tab);
                });
            });
        })();
    </script>
    @endsection
</body>
</html>