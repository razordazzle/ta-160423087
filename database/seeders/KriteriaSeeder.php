<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            ['nama_kriteria'=>'harga','jenis'=>'cost'],
            ['nama_kriteria'=>'jarak','jenis'=>'cost'],
            ['nama_kriteria'=>'rating','jenis'=>'benefit'],
            ['nama_kriteria'=>'fasilitas','jenis'=>'benefit'],
            ['nama_kriteria'=>'popularitas','jenis'=>'benefit'],
        ];
        
        foreach($data as $item){Kriteria::create($item);}
    }
}
