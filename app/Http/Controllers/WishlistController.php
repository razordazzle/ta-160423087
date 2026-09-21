<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\User;

class WishlistController extends Controller
{
    public function index(){
        $user=User::find(session('id_user'));
        $wishlist=$user->wishlist;

        return view('wishlist.index',compact('wishlist'));
    }

    public function tambah(Destinasi $destinasi){
        $user=User::find(session('id_user'));

        if(!$user->wishlist->contains($destinasi->id_destinasi))
            $user->wishlist()->attach($destinasi->id_destinasi);

        return back()->with('pesan','Ditambahkan ke wishlist.');
    }

    public function hapus(Destinasi $destinasi){
        $user=User::find(session('id_user'));
        $user->wishlist()->detach($destinasi->id_destinasi);

        return redirect()->route('wishlist.index');
    }
}
