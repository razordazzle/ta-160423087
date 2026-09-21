<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\GuestSessionService;

class EnsureGuestSession
{
    public function __construct(private GuestSessionService $guestSession){}

    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('id_user')){
            $user=$this->guestSession->getOrCreateGuest();
            session(['id_user'=>$user->id_user]);
        }

        return $next($request);
    }
}
