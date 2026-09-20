<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table='user';
    protected $primaryKey='id_user';
    public $timestamps=false;
    
    protected $fillable=['kode_sesi','email','password','waktu_dibuat'];

    public function wishlist(){
        return $this->belongsToMany(Destinasi::class,'wishlist','id_user','id_destinasi');
    }
}
