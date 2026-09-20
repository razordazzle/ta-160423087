<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=['Toilet','Mushola','Parkir','Warung Makan','Area Foto','WiFi'];
        foreach($data as $nama){
            Fasilitas::create(['nama_fasilitas'=>$nama]);
        }
    }
}
