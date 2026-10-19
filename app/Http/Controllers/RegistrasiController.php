<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrasiController extends Controller
{
    public function form(){
        if(User::find(session('id_user'))->email!=null) return redirect()->route('home');

        $sebelumnya=url()->previous();
        if(!str_starts_with($sebelumnya,route('login.form')) && !str_starts_with($sebelumnya,route('registrasi.form')))
            session(['auth_asal'=>$sebelumnya]);
        $asal=session('auth_asal',route('home'));

        return view('registrasi',compact('asal'));
    }

    public function store(Request $request){
        if(User::find(session('id_user'))->email!=null) return redirect()->route('home');
        
        $request->validate([
            'email'=>'required|email|unique:user,email',
            'password'=>'required|min:8|confirmed'
        ]);

        $user=User::find(session('id_user'));
        $user->update([
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        return redirect()->route('home')->with('pesan','Registrasi berhasil.');
    }
}
