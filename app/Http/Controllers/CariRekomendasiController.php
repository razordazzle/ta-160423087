<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pencarian;
use App\Services\GeocodingService;
use App\Services\GuestSessionService;

class CariRekomendasiController extends Controller
{
    public function lokasiForm(){
        return view('cari-rekomendasi.lokasi');
    }

    public function lokasiStore(Request $request, GeocodingService $geocoding){
        $request->validate(['lokasi_awal'=>'required|string|max:255']);

        $koordinat=$geocoding->geocode($request->lokasi_awal);

        if($koordinat===null) return back()->withErrors(['lokasi_awal'=>'Lokasi tidak ditemukan. Coba masukkan lokasi yang lebih spesifik.'])->withInput();

        $pencarian=Pencarian::create([
            'lokasi_awal'=>$request->lokasi_awal,
            'latitude_awal'=>$koordinat['latitude'],
            'longitude_awal'=>$koordinat['longitude'],
            'id_user'=>session('id_user')
        ]);

        session(['id_pencarian'=>$pencarian->id_pencarian]);

        return redirect()->route('cari-rekomendasi.preferensi');
    }

    public function preferensiForm(){
        return view('cari-rekomendasi.preferensi');
    }

    public function preferensiStore(Request $request,\App\Services\AhpService $ahp, \App\Services\SawService $saw){
        $request->validate(['pilihan'=>'required|in:personal,default']);

        if($request->pilihan==='personal') return redirect()->route('cari-rekomendasi.fasilitas');

        // pilihan default: lgsg hitung ahp (bobot default) + saw, tanpa input tambahan
        $pencarian=Pencarian::find(session('id_pencarian'));
        $bobotDefault=$ahp->bobotDefault();

        $kriteriaByNama=\App\Models\Kriteria::pluck('id_kriteria','nama_kriteria');
        $urutanKriteria=['harga','jarak','rating','fasilitas','popularitas'];

        $dataBobot=[];
        foreach($urutanKriteria as $index=>$nama){
            $dataBobot[$kriteriaByNama[$nama]]=['nilai_bobot'=>$bobotDefault[$index]];
        }
        $pencarian->kriteria()->sync($dataBobot);

        $hasilSaw=$saw->proses($pencarian,$bobotDefault);
        $saw->simpanHasil($pencarian,$hasilSaw);

        return redirect()->route('cari-rekomendasi.hasil');
    }

    public function fasilitasForm(){
        $fasilitas=\App\Models\Fasilitas::all();
        return view('cari-rekomendasi.fasilitas',compact('fasilitas'));
    }

    public function fasilitasStore(Request $request){
        $pencarian=Pencarian::find(session('id_pencarian'));

        $idFasilitas=$request->input('fasilitas',[]); // array, kosong kl gada yg dicentang
        $pencarian->fasilitasPrioritas()->sync($idFasilitas);

        return redirect()->route('cari-rekomendasi.perbandingan');
    }

    public function perbandinganForm(){
        $kriteria=\App\Models\Kriteria::pluck('nama_kriteria','id_kriteria');
        return view('cari-rekomendasi.perbandingan',compact('kriteria'));
    }

    public function perbandinganStore(Request $request,\App\Services\AhpService $ahp,\App\Services\SawService $saw){
        $request->validate([
            'nilai'=>'required|array|size:10',
            'nilai.*'=>'required|numeric'
        ]);

        $pencarian=Pencarian::find(session('id_pencarian'));

        \App\Models\PerbandinganBerpasangan::simpanDariInputAhp($pencarian->id_pencarian,$request->nilai);
        $nilaiInput=\App\Models\PerbandinganBerpasangan::ambilUntukAhp($pencarian->id_pencarian);

        $hasilAhp=$ahp->proses($nilaiInput);

        if(!$hasilAhp['konsisten'])
            return back()->withErrors(['cr'=>'Nilai perbandingan belum konsisten (CR = '.round($hasilAhp['cr'],3).'). Silakan sesuaikan kembali.']);

        $kriteriaByNama=\App\Models\Kriteria::pluck('id_kriteria','nama_kriteria');
        $urutanKriteria=['harga','jarak','rating','fasilitas','popularitas'];

        $dataBobot=[];
        foreach($urutanKriteria as $index=>$nama){
            $dataBobot[$kriteriaByNama[$nama]]=['nilai_bobot'=>$hasilAhp['bobot'][$index]];
        }
        $pencarian->kriteria()->sync($dataBobot);

        $hasilSaw=$saw->proses($pencarian,$hasilAhp['bobot']);
        $saw->simpanHasil($pencarian,$hasilSaw);

        return redirect()->route('cari-rekomendasi.hasil');
    }

    public function hasilShow(){
        $pencarian=Pencarian::find(session('id_pencarian'));

        if(!$pencarian) return redirect()->route('cari-rekomendasi.lokasi');

        $hasil=$pencarian->hasilRekomendasi()->orderByPivot('nilai_preferensi','desc')->get();

        return view('cari-rekomendasi.hasil',compact('hasil'));
    }
}
