<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\GuestSessionService;

class EnsureGuestSession
{
    public function __construct(private GuestSessionService $guestSession){}

    public function handle(Request $request, Closure $next)
    {
        $idUser=session('id_user');

        if(!$idUser || !User::whereKey($idUser)->exists()){
            $user=$this->guestSession->getOrCreateGuest();
            session(['id_user'=>$user->id_user]);
            session()->forget('id_pencarian');
        }

        return $next($request);
    }
}
