<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BobotDefault extends Model{
    protected $table='bobot_default';
    protected $primaryKey='id_kriteria';
    public $incrementing=false;
    public $timestamps=false;

    protected $fillable=['id_kriteria','nilai_bobot'];
}
?>