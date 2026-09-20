<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;

class HomeController extends Controller
{
    public function index(){
        $destinasiPopuler=Destinasi::orderByDesc('popularitas')->orderByDesc('rating')->take(2)->get();

        return view('home',compact('destinasiPopuler'));
    }
}
