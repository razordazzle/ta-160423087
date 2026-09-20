<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerbandinganBerpasangan extends Model{
    protected $table='perbandingan_berpasangan';
    public $timestamps=false;
    public $incrementing=false;

    protected $fillable=['id_pencarian','id_kriteria_baris','id_kriteria_kolom','nilai'];

    /**
     * simpan / perbarui 10 nilai perbandingan sekaligus, otomatis UPSERT,
     * jd aman dipanggil berulang kali kl CR gagal & user input ulang
     */
    public static function simpanUntukPencarian(int $idPencarian, array $baris):void{
        self::upsert(
            $baris,
            ['id_pencarian','id_kriteria_baris','id_kriteria_kolom'],
            ['nilai']
        );
    }

    /**
     * ambil 10 nilai u/ 1 Pencarian, terurut sesuai format input
     * AhpService::proses() [a12,a13,a14,a15,a23,a24,a25,a34,a35,a45]
     */
    public static function ambilUntukAhp(int $idPencarian):array{
        return self::where('id_pencarian',$idPencarian)
            ->orderBy('id_kriteria_baris')
            ->orderBy('id_kriteria_kolom')
            ->pluck('nilai')
            ->toArray();
    }

    /**
     * simpan 10 nilai mentah u/ 1 Pencarian, dr input yg sm
     * persis formatnya kayak yg msk ke AhpService::proses()
     */
    public static function simpanDariInputAhp(int $idPencarian, array $nilaiInput):void{
        $n=5;
        $baris=[];
        $index=0;

        for($i=1;$i<=$n;$i++){
            for($j=$i+1;$j<=$n;$j++){
                $baris[]=[
                    'id_pencarian'=>$idPencarian,
                    'id_kriteria_baris'=>$i,
                    'id_kriteria_kolom'=>$j,
                    'nilai'=>$nilaiInput[$index]
                ];
                $index++;
            }
        }
        self::simpanUntukPencarian($idPencarian,$baris);
    }
}
?>