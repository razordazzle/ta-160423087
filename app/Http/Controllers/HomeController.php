<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\User;

class HomeController extends Controller
{
    public function index(){
        $destinasiPopuler=Destinasi::orderByDesc('popularitas')->orderByDesc('rating')->take(2)->get();

        $user=User::find(session('id_user'));
        $jumlahWishlist=$user->wishlist->count();
        $sudahLogin=$user->email!==null;
        
        return view('home',compact('destinasiPopuler','jumlahWishlist','sudahLogin'));
    }
}
