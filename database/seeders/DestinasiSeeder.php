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
                'popularitas'=>42889,
                'deskripsi'=>'Pantai ikonik di Bali yang terkenal dengan pemandangan matahari terbenam dan ombak yang cocok untuk berselancar.',
                'kategori'=>['Pantai'],
                'fasilitas'=>['Toilet','Parkir','Warung Makan','Area Foto'],
                'gambar'=>'pantai-kuta.webp'
            ],
            [
                'nama'=>'Tanah Lot',
                'harga_tiket'=>40000,
                'latitude'=>-8.62107,
                'longitude'=>115.08716,
                'rating'=>4.6,
                'popularitas'=>103179,
                'deskripsi'=>'Pura suci Hindu yang berdiri di atas batu karang di tepi laut, terkenal dengan pemandangan matahari terbenam.',
                'kategori'=>['Pura','Pantai'],
                'fasilitas'=>['Toilet','Mushola','Parkir','Warung Makan','Area Foto'],
                'gambar'=>'tanah-lot.jpg'
            ],
            [
                'nama'=>'Pura Uluwatu',
                'harga_tiket'=>40000,
                'latitude'=>-8.8291,
                'longitude'=>115.0849,
                'rating'=>4.6,
                'popularitas'=>53154,
                'deskripsi'=>'Pura yang berdiri megah di ujung tebing karang, terkenal dengan pertunjukan Tari Kecak saat matahari terbenam.',
                'kategori'=>['Pura'],
                'fasilitas'=>['Toilet','Mushola','Parkir','Area Foto'],
                'gambar'=>'pura-uluwatu.jpg'
            ],
            [
                'nama'=>'Tegallalang Rice Terrace',
                'harga_tiket'=>25000,
                'latitude'=>-8.4312,
                'longitude'=>115.2777,
                'rating'=>4.4,
                'popularitas'=>55019,
                'deskripsi'=>'Hamparan sawah terasering ikonik dengan sistem irigasi Subak tradisional yang telah diakui UNESCO.',
                'kategori'=>['Alam'],
                'fasilitas'=>['Toilet','Parkir','Warung Makan','Area Foto','WiFi'],
                'gambar'=>'tegallalang-rice-terrace.jpg'
            ],
            [
                'nama'=>'Pura Ulun Danu Beratan',
                'harga_tiket'=>50000,
                'latitude'=>-8.27518201449342,
                'longitude'=>115.16682270829692,
                'rating'=>4.6,
                'popularitas'=>52543,
                'deskripsi'=>'Pura air yang berdiri di tepi Danau Beratan, dikenal luas sebagai salah satu ikon wisata Bali dan tercetak pada uang kertas pecahan Rp50.000.',
                'kategori'=>['Pura'],
                'fasilitas'=>['Toilet','Parkir','Warung Makan'],
                'gambar'=>'pura-ulun-danu-beratan.jpg'
            ],
            [
                'nama'=>'Sacred Monkey Forest Sanctuary',
                'harga_tiket'=>130000,
                'latitude'=>-8.51937340449865,
                'longitude'=>115.26062984592205,
                'rating'=>4.5,
                'popularitas'=>59849,
                'deskripsi'=>'Kawasan hutan konservasi di tengah Ubud yang menjadi habitat ratusan monyet ekor panjang, sekaligus rumah bagi beberapa pura kuno peninggalan abad ke-14.',
                'kategori'=>['Alam','Pura'],
                'fasilitas'=>['Toilet','Parkir','Warung Makan'],
                'gambar'=>'sacred-monkey-forest-sanctuary.jpg'
            ],
            [
                'nama'=>'Pantai Pandawa',
                'harga_tiket'=>15000,
                'latitude'=>-8.845282148023376,
                'longitude'=>115.18706609349867,
                'rating'=>4.6,
                'popularitas'=>45322,
                'deskripsi'=>'Pantai berpasir putih yang tersembunyi di balik tebing kapur tinggi, dikenal dengan julukan Pantai Rahasia sebelum berkembang menjadi destinasi wisata populer.',
                'kategori'=>['Pantai'],
                'fasilitas'=>['Toilet','Mushola','Parkir','Warung Makan'],
                'gambar'=>'pantai-pandawa.jpg'
            ],
            [
                'nama'=>'Pura Penataran Agung Lempuyang',
                'harga_tiket'=>55000,
                'latitude'=>-8.391798952937258,
                'longitude'=>115.63155871218468,
                'rating'=>4.0,
                'popularitas'=>12765,
                'deskripsi'=>'Pura yang terkenal dengan gerbang ikoniknya yang dijuluki Gate of Heaven, menampilkan pemandangan Gunung Agung yang membingkai sempurna di antara dua pilar gerbang.',
                'kategori'=>['Pura'],
                'fasilitas'=>['Toilet','Parkir','Warung Makan'],
                'gambar'=>'pura-penataran-agung-lempuyang.webp'
            ]
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
