<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table='kriteria';
    protected $primaryKey='id_kriteria';
    public $timestamps=false;
    
    protected $fillable=['nama_kriteria','jenis'];

    public function pencarian(){
        return $this->belongsToMany(Pencarian::class,'bobot_kriteria','id_kriteria','id_pencarian')->withPivot('nilai_bobot');
    }
}
