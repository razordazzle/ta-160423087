<!-- resources/views/registrasi.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
</head>
<body>
    @extends('layouts.app')

    @section('title','Registrasi')

    @section('content')
    <div class="max-w-md mx-auto px-6 pt-6 pb-10">
        {{-- Top bar --}}
        <div class="relative flex items-center">
            <a href="{{ route('home') }}" class="text-gray-700">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
            </a>
            <span class="absolute inset-x-0 text-center text-xs font-bold tracking-widest uppercase text-gray-500">Registrasi</span>
        </div>

        {{-- Header --}}
        <h1 class="mt-6 text-[28px] leading-tight font-heading font-bold text-gray-900">Daftar Akun</h1>
        <p class="text-gray-600 text-[15px] mt-2 leading-relaxed">Simpan preferensi dan wishlist Anda secara permanen dengan membuat akun.</p>

        @if ($errors->any())
            <div class="mt-4 flex items-center gap-2 bg-red-50 text-red-600 text-sm font-medium rounded-lg px-4 py-3">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 shrink-0">
                    <circle cx="12" cy="12" r="9"/>
                    <path d="M12 8v4M12 16h.01"/>
                </svg>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('registrasi.store') }}" class="mt-6">
            @csrf

            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
            <input id="email" type="email" name="email" placeholder="nama@email.com" value="{{ old('email') }}" required
                class="w-full bg-white border border-gray-200 rounded-2xl px-4 py-3.5 text-[15px] text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">

            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5 mt-5">Password</label>
            <div class="relative">
                <input id="password" type="password" name="password" placeholder="Password (min. 8 karakter)" required
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

            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1.5 mt-5">Konfirmasi Password</label>
            <div class="relative">
                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Ulangi password" required
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

            <button type="submit" class="mt-8 w-full bg-primary text-white font-bold text-[15px] rounded-full py-4 shadow-lg shadow-primary/20">Daftar</button>
        </form>

        <p class="mt-5 text-center text-sm text-gray-600">Sudah punya akun? <a href="{{ route('login.form') }}" class="text-secondary font-semibold">Masuk</a></p>
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
    </script>
    @endsection
</body>
</html>