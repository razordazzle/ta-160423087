<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\User;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(){
        $user=User::find(session('id_user'));
        $wishlist=$user->wishlist;

        $sebelumnya=url()->previous();
        if(!str_starts_with($sebelumnya,route('wishlist.index')) && !str_starts_with($sebelumnya,route('rekomendasi-rute.index')))
            session(['wishlist_asal'=>$sebelumnya]);
        $asal=session('wishlist_asal',route('home'));

        return view('wishlist.index',compact('wishlist','asal'));
    }

    public function hapus(Request $request,Destinasi $destinasi){
        $user=User::find(session('id_user'));
        $user->wishlist()->detach($destinasi->id_destinasi);

        // permintaan dari JavaScript (halaman wishlist): balas JSON tanpa reload
        if($request->expectsJson()){
            return response()->json(['jumlah'=>$user->wishlist()->count()]);
        }

        return redirect()->route('wishlist.index');
    }

    public function toggle(Request $request,Destinasi $destinasi){
        $user=User::find(session('id_user'));

        if($user->wishlist->contains($destinasi->id_destinasi)){
            $user->wishlist()->detach($destinasi->id_destinasi);
            $pesan='Dihapus dari wishlist.';
            $tersimpan=false;
        }
        else{
            $user->wishlist()->attach($destinasi->id_destinasi);
            $pesan='Ditambahkan ke wishlist.';
            $tersimpan=true;
        }

        // permintaan dari JavaScript (halaman hasil rekomendasi): balas JSON tanpa reload
        if($request->expectsJson()){
            return response()->json([
                'tersimpan'=>$tersimpan,
                'pesan'=>$pesan,
                'jumlah'=>$user->wishlist()->count()
            ]);
        }

        return redirect(url()->previous().'#dest-'.$destinasi->id_destinasi)->with('pesan',$pesan);
    }
}
