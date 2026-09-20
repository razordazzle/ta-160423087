<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destinasi extends Model
{
    protected $table='destinasi';
    protected $primaryKey='id_destinasi';
    public $timestamps=false;
    
    protected $fillable=['nama','harga_tiket','latitude','longitude','rating','popularitas','deskripsi'];

    public function kategori(){
        return $this->belongsToMany(Kategori::class,'destinasi_kategori','id_destinasi','id_kategori');
    }

    public function fasilitas(){
        return $this->belongsToMany(Fasilitas::class,'destinasi_fasilitas','id_destinasi','id_fasilitas');
    }
    
    public function hasilRekomendasi(){
        return $this->belongsToMany(Pencarian::class,'hasil_rekomendasi','id_destinasi','id_pencarian')->withPivot('nilai_preferensi');
    }
}
