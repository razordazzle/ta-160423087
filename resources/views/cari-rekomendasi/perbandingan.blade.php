<!-- resources/views/cari-rekomendasi/perbandingan.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferensi Kriteria</title>
    <style>
        input[type=range].ahp-slider {
            -webkit-appearance: none;
            appearance: none;
            width: 100%;
            height: 4px;
            background: #E2E8F0;
            border-radius: 9999px;
            outline: none;
        }
        input[type=range].ahp-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 26px;
            height: 26px;
            border-radius: 9999px;
            background: var(--color-primary);
            border: 5px solid #ffffff;
            box-shadow: 0 0 0 2px var(--color-primary);
            cursor: pointer;
        }
        input[type=range].ahp-slider::-moz-range-thumb {
            width: 26px;
            height: 26px;
            border-radius: 9999px;
            background: var(--color-primary);
            border: 5px solid #ffffff;
            box-shadow: 0 0 0 2px var(--color-primary);
            cursor: pointer;
        }
    </style>
</head>
<body>
    @extends('layouts.app')

    @section('title','Preferensi Kriteria')

    @section('content')
    <div class="max-w-md mx-auto px-6 pt-6 pb-10">
        {{-- Top bar --}}
        <div class="relative flex items-center">
            <a href="{{ route('cari-rekomendasi.fasilitas') }}" class="relative z-10 text-gray-700">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
            </a>
            <span class="absolute inset-x-0 text-center text-xs font-bold tracking-widest uppercase text-gray-500">Input Preferensi Kriteria</span>
        </div>

        {{-- Header --}}
        <h1 class="mt-6 text-2xl leading-tight font-heading font-bold text-gray-900">Preferensi Kriteria</h1>
        <p class="text-gray-600 text-[15px] mt-2 leading-relaxed">Geser ke arah kriteria yang menurut Anda lebih penting</p>

        @if($errors->any())
            <div class="mt-4 flex items-start gap-2 bg-red-50 text-red-600 text-sm font-medium rounded-lg px-4 py-3">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 shrink-0 mt-0.5">
                    <circle cx="12" cy="12" r="9"/>
                    <path d="M12 8v4M12 16h.01"/>
                </svg>
                <div>
                    <p>{{ $errors->first() }}</p>
                    @if($errors->has('cr'))
                        <button type="button" onclick="mulaiUlang()" class="mt-1 text-sm font-semibold underline">Mulai ulang dari awal</button>
                    @endif
                </div>
            </div>
        @endif

        {{-- Progress --}}
        <p class="mt-5 text-primary text-sm font-semibold">Perbandingan <span id="current-step">1</span> dari 10</p>
        <div class="mt-2 h-1.5 w-full bg-gray-200 rounded-full overflow-hidden">
            <div id="progress-bar" class="h-full bg-primary rounded-full transition-all" style="width: 10%"></div>
        </div>

        <form id="form-perbandingan" method="POST" action="{{ route('cari-rekomendasi.perbandingan.store') }}" class="mt-4">
            @csrf
            @php
                $pasangan=[[1,2],[1,3],[1,4],[1,5],[2,3],[2,4],[2,5],[3,4],[3,5],[4,5]];
            @endphp

            @foreach ($pasangan as $i=>[$a,$b])
                <div class="comparison-step {{ $i === 0 ? '' : 'hidden' }} bg-white rounded-2xl border border-gray-100 shadow-sm p-6" data-step="{{ $i + 1 }}">
                    @if (session('langkah_tinjau') == $i + 1)
                        <div class="mb-3 flex items-center gap-1 text-xs font-semibold text-amber-600">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 shrink-0">
                                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"/>
                                <path d="M12 9v4"/>
                                <path d="M12 17h.01"/>
                            </svg>
                            Perlu ditinjau
                        </div>
                    @endif
                    <div class="flex items-center justify-between">
                        <span class="capitalize font-heading font-bold text-xl text-primary">{{ $kriteria[$a] }}</span>
                        <span class="capitalize font-heading font-bold text-xl text-secondary">{{ $kriteria[$b] }}</span>
                    </div>

                    <div class="relative mt-8 h-7 flex items-center">
                        <div class="absolute inset-x-0 flex justify-between px-[2px] pointer-events-none">
                            @for ($d = 0; $d < 9; $d++)
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
                            @endfor
                        </div>
                        <input type="range" min="1" max="9" step="1" value="5" class="ahp-slider relative" data-index="{{ $i }}" oninput="updateSlider(this)">
                    </div>

                    <div class="mt-2 flex items-start justify-between text-xs">
                        <span class="capitalize w-1/3 text-left text-primary font-medium leading-snug">{{ $kriteria[$a] }} jauh lebih penting</span>
                        <span class="w-1/3 text-center text-gray-500 leading-snug">Sama penting</span>
                        <span class="capitalize w-1/3 text-right text-secondary font-medium leading-snug">{{ $kriteria[$b] }} jauh lebih penting</span>
                    </div>

                    <input type="hidden" name="nilai[{{ $i }}]" data-nilai-index="{{ $i }}" value="1">
                </div>
            @endforeach

            <div class="mt-6 flex gap-3">
                <button type="button" id="btn-sebelumnya" onclick="handleSebelumnya()" class="hidden flex-1 bg-white border border-gray-200 text-gray-700 font-bold text-[15px] rounded-2xl py-4 flex items-center justify-center gap-2">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    Sebelumnya
                </button>
                <button type="button" id="btn-lanjut" onclick="handleLanjut()" class="flex-1 flex items-center justify-center gap-2 bg-primary text-white font-bold text-[15px] rounded-2xl py-4 shadow-lg shadow-primary/20">
                    Lanjut
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                        <path d="M5 12h14M13 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <script>
        (function () {
            var totalStep=10;
            var skala=[9,7,5,3,1,1/3,1/5,1/7,1/9];
            var step={{ session('langkah_tinjau',1) }};
            var nilaiTersimpan=@json($nilaiTersimpan);

            function showStep(n){
                document.querySelectorAll('.comparison-step').forEach(function (el){
                    el.classList.toggle('hidden',Number(el.dataset.step)!==n);
                });
                document.getElementById('current-step').textContent = n;
                document.getElementById('progress-bar').style.width = (n / totalStep * 100) + '%';
                document.getElementById('btn-sebelumnya').classList.toggle('hidden',n===1);
            }

            window.updateSlider = function (rangeEl) {
                var index = rangeEl.dataset.index;
                var nilai = skala[Number(rangeEl.value) - 1];
                document.querySelector('input[type=hidden][data-nilai-index="' + index + '"]').value = nilai;
            };

            window.handleLanjut = function () {
                if (step < totalStep) {
                    step++;
                    showStep(step);
                } else {
                    document.getElementById('form-perbandingan').submit();
                }
            };

            window.handleSebelumnya=function(){
                if(step>1){
                    step--;
                    showStep(step);
                }
            }

            window.mulaiUlang=function(){
                document.querySelectorAll('input[type=range]').forEach(function(r){
                    r.value=5;
                    window.updateSlider(r);
                });
                step=1;
                showStep(step);
            }

            document.querySelectorAll('input[type=range]').forEach(function (r) {
                var tersimpan=nilaiTersimpan[Number(r.dataset.index)];
                if(tersimpan!==undefined){
                    var posisi=0;
                    skala.forEach(function(s,k){
                        if(Math.abs(s-tersimpan)<Math.abs(skala[posisi]-tersimpan)) posisi=k;
                    });
                    r.value=posisi+1;
                }
                window.updateSlider(r);
            });
            showStep(step);
        })();
    </script>
    @endsection
</body>
</html>