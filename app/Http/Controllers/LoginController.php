<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function form(){
        return view('login');
    }

    public function store(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $user=User::where('email',$request->email)->first();

        if(!$user||!Hash::check($request->password,$user->password))
            return back()->withErrors(['email'=>'Email atau password salah.'])->withInput();
        
        session(['id_user'=>$user->id_user]);

        return redirect()->route('home')->with('pesan','Login berhasil.');
    }

    public function logout(){
        session()->forget('id_user');
        Cookie::queue(Cookie::forget('kode_sesi'));
        return redirect()->route('home');
    }
}
