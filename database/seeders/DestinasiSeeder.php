<?php

namespace Database\Seeders;

use App\Models\Destinasi;
use App\Models\Kategori;
use App\Models\Fasilitas;
use Illuminate\Database\Seeder;

class DestinasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [
                'nama'=>'Pantai Kuta',
                'harga_tiket'=>0,
                'latitude'=>-8.7183,
                'longitude'=>115.1686,
                'rating'=>4.5,
                'popularitas'=>90,
                'deskripsi'=>'Pantai ikonik di Bali yang terkenal dengan pemandangan matahari terbenam dan ombak yang cocok untuk berselancar.',
                'kategori'=>['Pantai'],
                'fasilitas'=>['Toilet','Parkir','Warung Makan','Area Foto']
            ],
            [
                'nama'=>'Tanah Lot',
                'harga_tiket'=>40000,
                'latitude'=>-8.62107,
                'longitude'=>115.08716,
                'rating'=>4.6,
                'popularitas'=>95,
                'deskripsi'=>'Pura suci Hindu yang berdiri di atas batu karang di tepi laut, terkenal dengan pemandangan matahari terbenam.',
                'kategori'=>['Pura','Pantai'],
                'fasilitas'=>['Toilet','Mushola','Parkir','Warung Makan','Area Foto']
            ],
            [
                'nama'=>'Pura Uluwatu',
                'harga_tiket'=>40000,
                'latitude'=>-8.8291,
                'longitude'=>115.0849,
                'rating'=>4.7,
                'popularitas'=>93,
                'deskripsi'=>'Pura yang berdiri megah di ujung tebing karang, terkenal dengan pertunjukan Tari Kecak saat matahari terbenam.',
                'kategori'=>['Pura'],
                'fasilitas'=>['Toilet','Mushola','Parkir','Area Foto']
            ],
            [
                'nama'=>'Tegallalang Rice Terrace',
                'harga_tiket'=>25000,
                'latitude'=>-8.4312,
                'longitude'=>115.2777,
                'rating'=>4.5,
                'popularitas'=>85,
                'deskripsi'=>'Hamparan sawah terasering ikonik dengan sistem irigasi Subak tradisional yang telah diakui UNESCO.',
                'kategori'=>['Alam'],
                'fasilitas'=>['Toilet','Parkir','Warung Makan','Area Foto','WiFi']
            ],
        ];

        foreach($data as $item){
            $kategoriNames=$item['kategori'];
            $fasilitasNames=$item['fasilitas'];
            unset($item['kategori'],$item['fasilitas']);

            $destinasi=Destinasi::create($item);

            $kategoriIds=Kategori::whereIn('nama_kategori',$kategoriNames)->pluck('id_kategori');
            $destinasi->kategori()->attach($kategoriIds);

            $fasilitasIds=Fasilitas::whereIn('nama_fasilitas',$fasilitasNames)->pluck('id_fasilitas');
            $destinasi->fasilitas()->attach($fasilitasIds);
        }
    }
}
