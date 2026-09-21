<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrasiController extends Controller
{
    public function form(){
        return view('registrasi');
    }

    public function store(Request $request){
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
