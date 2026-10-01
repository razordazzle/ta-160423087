<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('partials.tombol-wishlist',function($view){
            $user=User::find(session('id_user'));
            $view->with('jumlahWishlist',$user?$user->wishlist()->count():0);
        });
    }
}
