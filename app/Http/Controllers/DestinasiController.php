<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinasi;
use App\Models\Kategori;

class DestinasiController extends Controller
{
    public function index(Request $request){
        $query=Destinasi::query();

        if($request->filled('kategori')){
            $query->whereHas('kategori',function ($q) use ($request){
                $q->where('kategori.id_kategori',$request->kategori);
            });
        }

        if($request->filled('q')) $query->where('nama','like','%'.$request->q.'%');

        $destinasiList=$query->get();
        $kategoriList=Kategori::all();

        return view('destinasi.index',compact('destinasiList','kategoriList'));
    }

    public function show(Destinasi $destinasi){
        return view('destinasi.show',compact('destinasi'));
    }
}
