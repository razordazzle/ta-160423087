<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table='fasilitas';
    protected $primaryKey='id_fasilitas';
    public $timestamps=false;
    
    protected $fillable=['nama_fasilitas'];

    public function destinasi(){
        return $this->belongsToMany(Destinasi::class,'destinasi_fasilitas','id_fasilitas','id_destinasi');
    }

    public function pencarian(){
        return $this->belongsToMany(Pencarian::class,'pencarian_fasilitas','id_fasilitas','id_pencarian');
    }
}
