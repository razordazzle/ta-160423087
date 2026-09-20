<?php
namespace App\Services;

use App\Models\Destinasi;
use App\Models\Pencarian;

class SawService{
    private const JENIS_KRITERIA=[
        'harga'=>'cost',
        'jarak'=>'cost',
        'rating'=>'benefit',
        'fasilitas'=>'benefit',
        'popularitas'=>'benefit'
    ];

    // formula haversine, hasil dlm km
    private function hitungJarak(float $lat1,float $lon1,float $lat2,float $lon2):float{
        $R=6371;
        $dLat=deg2rad($lat2-$lat1);
        $dLon=deg2rad($lon2-$lon1);
        $a=sin($dLat/2)**2+cos(deg2rad($lat1))*cos(deg2rad($lat2))*sin($dLon/2)**2;
        $c=2*atan2(sqrt($a),sqrt(1-$a));
        return $R*$c;
    }

    // nilai kriteria fasilitas: total jika tanpa preferensi, irisan jika ada (subbab 4.2.8)
    private function hitungFasilitas(Destinasi $destinasi,$idFasilitasDiinginkan):int{
        $idFasilitasDimiliki=$destinasi->fasilitas->pluck('id_fasilitas');
        
        if($idFasilitasDiinginkan->isEmpty()) return $idFasilitasDimiliki->count();

        return $idFasilitasDiinginkan->intersect($idFasilitasDimiliki)->count();
    }

    // bentuk matrix keputusan (xij) u/ seluruh destinasi
    private function bentukMatriks(Pencarian $pencarian):array{
        $destinasiSemua=Destinasi::with('fasilitas')->get();
        $idFasilitasDiinginkan=$pencarian->fasilitasPrioritas->pluck('id_fasilitas');

        $matriks=[];
        foreach($destinasiSemua as $destinasi){
            $matriks[$destinasi->id_destinasi]=[
                'harga'=>$destinasi->harga_tiket,
                'jarak'=>$this->hitungJarak(
                    $pencarian->latitude_awal,$pencarian->longitude_awal,
                    $destinasi->latitude,$destinasi->longitude
                ),
                'rating'=>$destinasi->rating,
                'fasilitas'=>$this->hitungFasilitas($destinasi,$idFasilitasDiinginkan),
                'popularitas'=>$destinasi->popularitas
            ];
        }
        
        return [$matriks,$destinasiSemua];
    }

    // normalisasi matriks sesuai jenis kriteria (rumus 2.3-2.4, subbab 2.3.3)
    private function normalisasiMatriks(array $matriks):array{
        $normalisasi=[];
        
        foreach(self::JENIS_KRITERIA as $nama=>$jenis){
            $nilaiSemua=array_column($matriks,$nama);
            $min=min($nilaiSemua);
            $max=max($nilaiSemua);

            foreach($matriks as $idDestinasi=>$baris){
                $x=$baris[$nama];

                if($jenis==='benefit') $r=$max>0?$x/$max:0;
                else $r=($x==0)?1:$min/$x; // edge case (subbab 4.1.2): nilai 0 pd kriteria cost = normalisasi terbaik (1)

                $normalisasi[$idDestinasi][$nama]=$r;
            }
        }

        return $normalisasi;
    }

    // method utama: dari Pencarian + bobot AHP, hasil sdh terurut menurun
    public function proses(Pencarian $pencarian,array $bobot):array{
        [$matriks,$destinasiSemua]=$this->bentukMatriks($pencarian);
        $normalisasi=$this->normalisasiMatriks($matriks);

        $hasil=[];
        foreach($normalisasi as $idDestinasi=>$nilai){
            $v=$bobot[0]*$nilai['harga']
                +$bobot[1]*$nilai['jarak']
                +$bobot[2]*$nilai['rating']
                +$bobot[3]*$nilai['fasilitas']
                +$bobot[4]*$nilai['popularitas'];

            $hasil[]=[
                'destinasi'=>$destinasiSemua->firstWhere('id_destinasi',$idDestinasi),
                'nilai_preferensi'=>$v
            ];
        }

        usort($hasil,fn($a,$b)=>$b['nilai_preferensi']<=>$a['nilai_preferensi']);

        return $hasil;
    }

    // simpan ke entitas Hasil Rekomendasi (subbab 4.1.1)
    public function simpanHasil(Pencarian $pencarian,array $hasil):void{
        $data=[];
        foreach($hasil as $item){
            $data[$item['destinasi']->id_destinasi]=['nilai_preferensi'=>$item['nilai_preferensi']];
        }
        $pencarian->hasilRekomendasi()->sync($data);
    }
}
?>