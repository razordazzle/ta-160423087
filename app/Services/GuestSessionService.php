<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class GuestSessionService{
    private const COOKIE_NAME='kode_sesi';
    private const COOKIE_UMUR=525600; // 1 tahun dlm menit, sesuai 4.1.1

    // ambil user aktif dari cookie / buat baru sbg guest kl blm ada
    public function getOrCreateGuest():User{
        $kodeSesi=request()->cookie(self::COOKIE_NAME);

        if($kodeSesi){
            $user=User::where('kode_sesi',$kodeSesi)->first();
            if($user) return $user;
        }

        $kodeSesiBaru=(string)Str::uuid();
        $user=User::create(['kode_sesi'=>$kodeSesiBaru]);
        Cookie::queue(self::COOKIE_NAME,$kodeSesiBaru,self::COOKIE_UMUR);

        return $user;
    }
}
?>