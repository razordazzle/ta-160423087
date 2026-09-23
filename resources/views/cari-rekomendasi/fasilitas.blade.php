<!-- resources/views/cari-rekomendasi/fasilitas.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasilitas Prioritas</title>
</head>
<body>
    @extends('layouts.app')

    @section('title','Fasilitas Prioritas')

    @section('content')
    <div class="max-w-md mx-auto px-6 pt-6 pb-10">
        {{-- Top bar --}}
        <div class="relative flex items-center">
            <a href="{{ route('cari-rekomendasi.preferensi') }}" class="text-gray-700">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
            </a>
            <span class="absolute inset-x-0 text-center text-xs font-bold tracking-widest uppercase text-gray-500">Fasilitas Prioritas</span>
        </div>

        {{-- Header --}}
        <h1 class="mt-6 text-2xl leading-tight font-heading font-bold text-gray-900">Fasilitas Prioritas</h1>
        <p class="text-gray-600 text-[15px] mt-2 leading-relaxed">Pilih fasilitas yang penting bagi Anda (opsional). Jika tidak memilih, seluruh fasilitas akan dianggap sesuai.</p>

        <form method="POST" action="{{ route('cari-rekomendasi.fasilitas.store') }}" class="mt-6">
            @csrf

            <div class="space-y-3">
                @foreach ($fasilitas as $f)
                    @php
                        $nama = strtolower($f->nama_fasilitas);
                        $iconKey = match(true) {
                            str_contains($nama, 'toilet') => 'toilet',
                            str_contains($nama, 'mushola') => 'mushola',
                            str_contains($nama, 'parkir') => 'parkir',
                            str_contains($nama, 'warung') => 'warung',
                            str_contains($nama, 'foto') => 'foto',
                            str_contains($nama, 'wifi') => 'wifi',
                            default => 'default',
                        };
                    @endphp
                    <label class="group flex items-center gap-3 bg-white rounded-2xl border-2 border-gray-100 p-4 has-[:checked]:border-primary has-[:checked]:bg-primary/5 transition-colors cursor-pointer">
                        <input type="checkbox" name="fasilitas[]" value="{{ $f->id_fasilitas }}" class="sr-only">

                        <span class="shrink-0 w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                            @switch($iconKey)
                                @case('toilet')
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                        <rect x="7" y="3" width="10" height="18" rx="2"/>
                                        <path d="M7 9h10"/>
                                    </svg>
                                    @break
                                @case('mushola')
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                        <path d="M4 21V10l8-6 8 6v11"/>
                                        <path d="M9 21v-6h6v6"/>
                                    </svg>
                                    @break
                                @case('parkir')
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                        <rect x="3" y="3" width="18" height="18" rx="4"/>
                                        <path d="M9 16V8h3.5a2.5 2.5 0 0 1 0 5H9"/>
                                    </svg>
                                    @break
                                @case('warung')
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                        <path d="M4 8h13v5a5 5 0 0 1-5 5H9a5 5 0 0 1-5-5V8Z"/>
                                        <path d="M17 9h2a2 2 0 0 1 0 4h-2"/>
                                        <path d="M8 2v2M12 2v2"/>
                                    </svg>
                                    @break
                                @case('foto')
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                        <path d="M4 8h3l2-2h6l2 2h3v11H4V8Z"/>
                                        <circle cx="12" cy="13" r="3.5"/>
                                    </svg>
                                    @break
                                @case('wifi')
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                        <path d="M2 8.5a16 16 0 0 1 20 0"/>
                                        <path d="M5.5 12.5a11 11 0 0 1 13 0"/>
                                        <path d="M9 16.5a6 6 0 0 1 6 0"/>
                                        <circle cx="12" cy="20" r="1"/>
                                    </svg>
                                    @break
                                @default
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                        <circle cx="12" cy="12" r="9"/>
                                        <path d="M9 12l2 2 4-4"/>
                                    </svg>
                            @endswitch
                        </span>

                        <span class="flex-1 font-medium text-gray-900 text-[15px]">{{ $f->nama_fasilitas }}</span>

                        <span class="shrink-0 w-6 h-6 rounded-md border-2 border-gray-200 flex items-center justify-center group-has-[:checked]:bg-primary group-has-[:checked]:border-primary transition-colors">
                            <svg class="w-3.5 h-3.5 text-white opacity-0 group-has-[:checked]:opacity-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 6 9 17l-5-5"/>
                            </svg>
                        </span>
                    </label>
                @endforeach
            </div>

            <button type="submit" class="mt-6 w-full flex items-center justify-center gap-2 bg-primary text-white font-bold text-[15px] rounded-2xl py-4 shadow-lg shadow-primary/20">
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