<?php
namespace App\Services;

class AhpService{
    private const JUMLAH_KRITERIA=5;
    private const RANDOM_INDEX=1.12; //RI untuk n=5 (tabel Saaty)
    private const BATAS_CR=0.10;

    /**
     * bentuk matriks 5x5 dari 10 nilai input user
     * urutan input: [a12, a13, a14, a15, a23, a24, a25, a34, a35, a45]
     * kriteria: 0=harga, 1=jarak, 2=rating, 3=fasilitas, 4=popularitas (sesuai tabel 4.2)
     */
    public function bentukMatriks(array $nilaiInput):array{
        $n=self::JUMLAH_KRITERIA;
        $matriks=array_fill(0,$n,array_fill(0,$n,1));

        $indexInput=0;
        for($i=0;$i<$n;$i++){
            for($j=$i+1;$j<$n;$j++){
                $nilai=$nilaiInput[$indexInput];
                $matriks[$i][$j]=$nilai;
                $matriks[$j][$i]=1/$nilai;
                $indexInput++;
            }
        }
        return $matriks;
    }

    //normalisasi: tiap nilai dibagi jum. kolom
    public function normalisasiMatriks(array $matriks):array{
        $n=count($matriks);
        $jumlahKolom=array_fill(0,$n,0);

        for($j=0;$j<$n;$j++){
            for($i=0;$i<$n;$i++){
                $jumlahKolom[$j]+=$matriks[$i][$j];
            }
        }

        $normalisasi=[];
        for($i=0;$i<$n;$i++){
            for($j=0;$j<$n;$j++){
                $normalisasi[$i][$j]=$matriks[$i][$j]/$jumlahKolom[$j];
            }
        }
        return $normalisasi;
    }

    //bobot: rata2 tiap baris di matriks ternormalisasi
    public function hitungBobot(array $matriksNormalisasi):array{
        $n=count($matriksNormalisasi);
        $bobot=[];

        for($i=0;$i<$n;$i++){
            $bobot[$i]=array_sum($matriksNormalisasi[$i])/$n;
        }
        return $bobot;
    }

    //consistency ratio, via lambda max dari matriks asli x bobot
    public function hitungCR(array $matriks, array $bobot):float{
        $n=count($matriks);
        
        $weightedSum=[];
        for($i=0;$i<$n;$i++){
            $jumlah=0;
            for($j=0;$j<$n;$j++){
                $jumlah+=$matriks[$i][$j]*$bobot[$j];
            }
            $weightedSum[$i]=$jumlah;
        }

        $lambdaMax=0;
        for($i=0;$i<$n;$i++){
            $lambdaMax+=$weightedSum[$i]/$bobot[$i];
        }

        $lambdaMax/=$n;
        $ci=($lambdaMax-$n)/($n-1);

        return $ci/self::RANDOM_INDEX;
    }

    //method utama: dari input pengguna sampe bobot finatl + status konsistensi
    public function proses(array $nilaiInput):array{
        $matriks=$this->bentukMatriks($nilaiInput);
        $normalisasi=$this->normalisasiMatriks($matriks);
        $bobot=$this->hitungBobot($normalisasi);
        $cr=$this->hitungCR($matriks,$bobot);

        return[
            'bobot'=>$bobot,
            'cr'=>$cr,
            'konsisten'=>$cr<self::BATAS_CR,
        ];
    }

    //bobot default (tabel 4.4), dipake kl user skip preferensi personal
    public function bobotDefault():array{
        return [0.1965,0.1991,0.2123,0.2070,0.1851];
    }
}
?>