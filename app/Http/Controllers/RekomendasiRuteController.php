<?php

namespace App\Http\Controllers;

use App\Models\Pencarian;
use App\Models\User;
use App\Services\OsrmService;

class RekomendasiRuteController extends Controller
{
    public function index(OsrmService $osrm){
        $user=User::find(session('id_user'));
        $wishlistItems=$user->wishlist;

        if($wishlistItems->isEmpty())
            return redirect()->route('wishlist.index')->with('pesan','Wishlist Anda masihg kosong.');

        $pencarian=Pencarian::where('id_user',$user->id_user)->latest('waktu_pencarian')->first();

        if(!$pencarian)
            return redirect()->route('cari-rekomendasi.lokasi')->with('pesan','Silakan isi lokasi awal terlebih dahulu.');

        $lokasiAwal=['latitude'=>$pencarian->latitude_awal,'longitude'=>$pencarian->longitude_awal];
        $hasilRute=$osrm->hitungRute($lokasiAwal,$wishlistItems);

        if($hasilRute===null)
            return back()->withErrors(['osrm'=>'Gagal menghitung rute. Silakan coba lagi.']);

        return view('rekomendasi-rute.index',compact('hasilRute'));
    }
}
