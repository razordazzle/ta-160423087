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
            <a href="{{ route('home') }}" class="relative z-10 text-gray-700">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
            </a>
            <span class="absolute inset-x-0 text-center text-xs font-bold tracking-widest uppercase text-gray-500">Input Lokasi</span>
        </div>

        {{-- Header --}}
        <h1 class="mt-10 text-2xl leading-tight font-heading font-bold text-gray-900 text-center">Cari Destinasi Wisata di Bali</h1>
        <p class="text-secondary text-[15px] mt-3 text-center leading-relaxed">Masukkan lokasi awal Anda<br>(nama hotel atau penginapan)</p>

        @if(session('pesan'))
            <div class="mt-4 flex items-center gap-2 bg-primary/10 text-primary text-sm font-medium rounded-lg px-4 py-3">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 shrink-0">
                    <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                {{ session('pesan') }}
            </div>
        @endif

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
            <input type="hidden" name="place_id" id="place_id">

            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                        <path d="M12 21s7-7.5 7-12a7 7 0 1 0-14 0c0 4.5 7 12 7 12Z"/>
                        <circle cx="12" cy="9" r="2.5"/>
                    </svg>
                </span>
                <input id="lokasi_awal" type="text" name="lokasi_awal" autocomplete="off" placeholder="Contoh: Ayana Resort Bali" value="{{ old('lokasi_awal') }}" required
                    class="w-full bg-white border border-gray-200 rounded-2xl pl-11 pr-4 py-3.5 text-[15px] text-gray-900 placeholder-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                    <div id="saran-lokasi" class="hidden absolute left-0 right-0 top-full mt-2 z-20 bg-white border border-gray-200 rounded-2xl shadow-lg overflow-hidden">
                        <ul id="daftar-saran" role="listbox"></ul>
                        <p translate="no" class="border-t border-gray-100 px-4 py-2 text-right text-xs font-normal text-[#5E5E5E]" style="font-family: Roboto, sans-serif;">Google Maps</p>
                    </div>
            </div>

            <template id="tpl-saran">
                <li role="option" aria-selected="false" class="flex items-center gap-3 px-4 py-3 cursor-pointer hover:bg-gray-50 aria-selected:bg-primary/5">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 shrink-0 text-gray-400">
                        <path d="M12 21s7-7.5 7-12a7 7 0 1 0-14 0c0 4.5 7 12 7 12Z"/>
                        <circle cx="12" cy="9" r="2.5"/>
                    </svg>
                    <div class="min-w-0 flex-1">
                        <span data-utama class="block text-[15px] font-medium text-gray-900 truncate"></span>
                        <span data-keterangan class="block text-xs text-gray-500 truncate"></span>
                    </div>
                </li>
            </template>

            <button type="submit" class="mt-4 w-full flex items-center justify-center gap-2 bg-primary text-white font-bold text-[15px] rounded-2xl py-4 shadow-lg shadow-primary/20">
                Lanjut
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                    <path d="M5 12h14M13 5l7 7-7 7"/>
                </svg>
            </button>
        </form>
    </div>
    <script>
        var input=document.getElementById('lokasi_awal');
        var kotak=document.getElementById('saran-lokasi');
        var daftar=document.getElementById('daftar-saran');
        var templateItem=document.getElementById('tpl-saran');
        var inputPlaceId=document.getElementById('place_id');
        var urlSaran="{{ route('cari-rekomendasi.lokasi.saran',[],false) }}";

        var timer=null; // debounce
        var permintaan=null; // AbortController utk req yg lg jalan

        function tutup(){
            kotak.classList.add('hidden');
        }
        
        function batalkan(){
            clearTimeout(timer);
            if(permintaan) permintaan.abort();
        }

        function pilih(saran){
            batalkan();
            input.value=saran.utama;
            inputPlaceId.value=saran.place_id;
            tutup();
        }

        function tampilkan(hasil){
            daftar.innerHTML='';
            if(hasil.length===0){
                tutup();
                return;
            }

            hasil.forEach(function(saran){
                var item=templateItem.content.firstElementChild.cloneNode(true);
                item.querySelector('[data-utama]').textContent=saran.utama;
                item.querySelector('[data-keterangan]').textContent=saran.keterangan;
                item.addEventListener('click',function(){ pilih(saran); });
                daftar.appendChild(item);
            });

            kotak.classList.remove('hidden');
        }

        function cari(q){
            permintaan=new AbortController();

            fetch(urlSaran+'?q='+encodeURIComponent(q),{
                headers:{ 'Accept': 'application/json' },
                signal:permintaan.signal
            }).then(function(r){ return r.ok ? r.json() : [] }).then(tampilkan).catch(function(e){ if(e.name !== 'AbortError') tutup(); });
        }

        input.addEventListener('input',function(){
            batalkan();
            inputPlaceId.value=''; // text diubah manual, pilihan sblmnya ga berlaku

            var q=input.value.trim();
            if(q.length<3){
                tutup();
                return;
            }

            timer=setTimeout(function(){ cari(q); },300);
        });

        document.addEventListener('pointerdown',function(e){
            if(!kotak.contains(e.target) && e.target !== input) tutup();
        });
    </script>
    @endsection
</body>
</html>