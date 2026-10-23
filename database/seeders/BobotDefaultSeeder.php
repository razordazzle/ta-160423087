<?php

namespace Database\Seeders;

use App\Models\BobotDefault;
use App\Models\Kriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BobotDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bobot=[
            'harga'=>0.1965,
            'jarak'=>0.1991,
            'rating'=>0.2123,
            'fasilitas'=>0.2070,
            'popularitas'=>0.1851
        ];

        $idKriteria=Kriteria::pluck('id_kriteria','nama_kriteria');
        foreach($bobot as $nama=>$nilai){
            BobotDefault::create(['id_kriteria'=>$idKriteria[$nama],'nilai_bobot'=>$nilai]);
        }
    }
}
