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

    // endpoint JSON utk dropdown saran lokasi. via server supaya API key ga keluar ke browser
    public function saranLokasi(Request $request,GeocodingService $geocoding){
        $request->validate(['q'=>'required|string|min:3|max:100']);

        return response()->json($geocoding->saranLokasi($request->q));
    }

    public function lokasiStore(Request $request, GeocodingService $geocoding){
        $request->validate([
            'lokasi_awal'=>'required|string|max:255',
            'place_id'=>'nullable|string|max:255'
        ]);

        $koordinat=null;

        // user pilih salah satu saran -> geocoding via place_id
        if($request->filled('place_id'))
            $koordinat=$geocoding->geocode($request->lokasi_awal,$request->place_id);

        // diketik bebas / lookup place_id gagal -> geocoding via text spt sebelumnya
        if($koordinat===null)
            $koordinat=$geocoding->geocode($request->lokasi_awal);

        if($koordinat===null) return back()->withErrors(['lokasi_awal'=>'Lokasi tidak ditemukan. Coba masukkan lokasi yang lebih spesifik.'])->withInput();

        $pencarian=Pencarian::create([
            'lokasi_awal'=>$request->lokasi_awal,
            'latitude_awal'=>$koordinat['latitude'],
            'longitude_awal'=>$koordinat['longitude'],
            'id_user'=>session('id_user')
        ]);

        session(['id_pencarian'=>$pencarian->id_pencarian]);

        if(session()->has('tujuan_setelah_lokasi'))
            return redirect(session()->pull('tujuan_setelah_lokasi'));

        return redirect()->route('cari-rekomendasi.preferensi');
    }

    public function preferensiForm(){
        return view('cari-rekomendasi.preferensi');
    }

    public function preferensiStore(Request $request,\App\Services\SawService $saw){
        $request->validate(['pilihan'=>'required|in:personal,default']);

        if($request->pilihan==='personal') return redirect()->route('cari-rekomendasi.fasilitas');

        // pilihan default: lgsg hitung ahp (bobot default) + saw, tanpa input tambahan
        $pencarian=Pencarian::find(session('id_pencarian'));
        
        $bobotDefault=\App\Models\BobotDefault::orderBy('id_kriteria')->pluck('nilai_bobot','id_kriteria');
        $pencarian->kriteria()->sync($bobotDefault->map(fn($nilai)=>['nilai_bobot'=>$nilai])->all());

        $hasilSaw=$saw->proses($pencarian,$bobotDefault->values()->all());
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
        $nilaiTersimpan=\App\Models\PerbandinganBerpasangan::ambilUntukAhp((int)session('id_pencarian'));
        return view('cari-rekomendasi.perbandingan',compact('kriteria','nilaiTersimpan'));
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

        $urutanKriteria=['harga','jarak','rating','fasilitas','popularitas'];        
        if(!$hasilAhp['konsisten']){
            $menyimpang=$ahp->cariPasanganMenyimpang($nilaiInput,$hasilAhp['bobot']);

            return redirect()->route('cari-rekomendasi.perbandingan')
                ->with('langkah_tinjau',$menyimpang['langkah'])
                ->withErrors(['cr'=>'Penilaian belum konsisten (CR = '.round($hasilAhp['cr'],3).'). Perbandingan '.$urutanKriteria[$menyimpang['baris']].' dan '.$urutanKriteria[$menyimpang['kolom']].' paling menyimpang, mohon tinjau kembali.']);
        }

        $kriteriaByNama=\App\Models\Kriteria::pluck('id_kriteria','nama_kriteria');
        
        $dataBobot=[];
        foreach($urutanKriteria as $index=>$nama){
            $dataBobot[$kriteriaByNama[$nama]]=['nilai_bobot'=>$hasilAhp['bobot'][$index]];
        }
        $pencarian->kriteria()->sync($dataBobot);

        $hasilSaw=$saw->proses($pencarian,$hasilAhp['bobot']);
        $saw->simpanHasil($pencarian,$hasilSaw);

        return redirect()->route('cari-rekomendasi.hasil');
    }

    public function hasilShow(Request $request){
        $pencarian=Pencarian::find(session('id_pencarian'));
        if(!$pencarian) return redirect()->route('cari-rekomendasi.lokasi');

        $hasil=$pencarian->hasilRekomendasi()->orderByPivot('nilai_preferensi','desc')->get();
        $idWishlist=\App\Models\User::find(session('id_user'))->wishlist->pluck('id_destinasi')->all();
        $asal=$request->query('dari')==='akun'?route('akun.index',['tab'=>'riwayat']):route('home');

        $langkah=5;
        $batas=max($langkah,(int)$request->query('tampil',$langkah));
        $tampil=$hasil->take($batas);

        return view('cari-rekomendasi.hasil',compact('hasil','pencarian','idWishlist','asal','tampil','batas','langkah'));
    }
}
