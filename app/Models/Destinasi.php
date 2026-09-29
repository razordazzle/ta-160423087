<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

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

    public function popularitasSingkat():Attribute{
        return Attribute::make(get:function(){
            $n=(int)round($this->popularitas);
            $ringkas=fn($nilai)=>rtrim(rtrim(number_format($nilai,1,',',''),'0'),',');

            if($n>=1000000) return $ringkas($n/1000000).' jt';
            if($n>=10000) return number_format($n/1000,0,',','').' rb';
            if($n>=1000) return $ringkas($n/1000).' rb';

            return (string)$n;
        });
    }
}
