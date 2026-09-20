<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pencarian extends Model
{
    protected $table='pencarian';
    protected $primaryKey='id_pencarian';
    public $timestamps=false;
    
    protected $fillable=['lokasi_awal','latitude_awal','longitude_awal','waktu_pencarian','id_user'];

    public function kriteria(){
        return $this->belongsToMany(Kriteria::class,'bobot_kriteria','id_pencarian','id_kriteria')->withPivot('nilai_bobot');
    }

    public function fasilitasPrioritas(){
        return $this->belongsToMany(Fasilitas::class,'pencarian_fasilitas','id_pencarian','id_fasilitas');
    }

    public function hasilRekomendasi(){
        return $this->belongsToMany(Destinasi::class,'hasil_rekomendasi','id_pencarian','id_destinasi')->withPivot('nilai_preferensi');
    }
}
