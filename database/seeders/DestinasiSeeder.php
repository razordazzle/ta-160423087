<?php

namespace Database\Seeders;

use App\Models\Destinasi;
use App\Models\Kategori;
use App\Models\Fasilitas;
use Illuminate\Database\Seeder;

class DestinasiSeeder extends Seeder
{
    public function run(): void {
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
                'kategori'=>['Pura','Alam'],
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
                'kategori'=>['Alam','Pura','Satwa'],
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
            ],
            [
                'nama'=>'Pantai Melasti',
                'harga_tiket'=>10000,
                'latitude'=>-8.847759893543687,
                'longitude'=>115.1606812262493,
                'rating'=>4.8,
                'popularitas'=>25758,
                'deskripsi'=>'Pantai berpasir putih di Ungasan yang diapit tebing kapur tinggi, dengan air laut biru jernih dan jalan menurun yang membelah tebing.',
                'kategori'=>['Pantai'],
                'fasilitas'=>['Toilet','Parkir','Warung Makan','Area Foto'],
                'gambar'=>'pantai-melasti.jpg'
            ],
            [
                'nama'=>'Pantai Lovina',
                'harga_tiket'=>0,
                'latitude'=>-8.16153798285993,
                'longitude'=>115.0240545207996,
                'rating'=>4.3,
                'popularitas'=>1766,
                'deskripsi'=>'Pantai berpasir hitam di Bali utara yang terkenal dengan wisata melihat lumba-lumba pada pagi hari dan suasananya yang tenang.',
                'kategori'=>['Pantai'],
                'fasilitas'=>['Toilet','Parkir','Warung Makan','Area Foto'],
                'gambar'=>'pantai-lovina.jpg'
            ],
            [
                'nama'=>'Pura Tirta Empul',
                'harga_tiket'=>50000,
                'latitude'=>-8.415722556347921,
                'longitude'=>115.31534982193493,
                'rating'=>4.6,
                'popularitas'=>31412,
                'deskripsi'=>'Pura di Tampaksiring dengan kolam mata air suci yang digunakan umat Hindu untuk ritual melukat atau penyucian diri.',
                'kategori'=>['Pura'],
                'fasilitas'=>['Toilet','Parkir','Warung Makan'],
                'gambar'=>'pura-tirta-empul.jpg'
            ],
            [
                'nama'=>'Pura Besakih',
                'harga_tiket'=>80000,
                'latitude'=>-8.374018820564176,
                'longitude'=>115.45255669741036,
                'rating'=>4.4,
                'popularitas'=>19531,
                'deskripsi'=>'Kompleks pura terbesar dan terpenting di Bali yang berada di lereng Gunung Agung, dikenal sebagai Pura Induk umat Hindu Bali.',
                'kategori'=>['Pura'],
                'fasilitas'=>['Toilet','Parkir','Warung Makan'],
                'gambar'=>'pura-besakih.jpg'
            ],
            [
                'nama'=>'Pura Taman Ayun',
                'harga_tiket'=>15000,
                'latitude'=>-8.54186371115684,
                'longitude'=>115.17248429741194,
                'rating'=>4.6,
                'popularitas'=>10196,
                'deskripsi'=>'Pura peninggalan Kerajaan Mengwi yang dikelilingi kolam dan taman luas, dengan bangunan meru bertingkat yang khas.',
                'kategori'=>['Pura'],
                'fasilitas'=>['Toilet','Parkir','Area Foto'],
                'gambar'=>'pura-taman-ayun.jpeg'
            ],
            [
                'nama'=>'Gunung Batur',
                'harga_tiket'=>25000,
                'latitude'=>-8.240469002916385,
                'longitude'=>115.37749423587606,
                'rating'=>4.5,
                'popularitas'=>4839,
                'deskripsi'=>'Gunung api aktif di Kintamani dengan Danau Batur di kakinya, terkenal sebagai tempat mendaki untuk menikmati pemandangan matahari terbit.',
                'kategori'=>['Alam'],
                'fasilitas'=>['Toilet','Parkir','Warung Makan'],
                'gambar'=>'gunung-batur.jpg'
            ],
            [
                'nama'=>'Jatiluwih Rice Terrace',
                'harga_tiket'=>25000,
                'latitude'=>-8.37011542078092,
                'longitude'=>115.13122689741049,
                'rating'=>4.8,
                'popularitas'=>15996,
                'deskripsi'=>'Hamparan sawah terasering di kaki Gunung Batukaru yang menggunakan sistem irigasi subak dan diakui sebagai Warisan Budaya Dunia UNESCO.',
                'kategori'=>['Alam'],
                'fasilitas'=>['Toilet','Parkir','Warung Makan','Area Foto'],
                'gambar'=>'jatiluwih-rice-terrace.jpg'
            ],
            [
                'nama'=>'Tegenungan Waterfall',
                'harga_tiket'=>30000,
                'latitude'=>-8.575393918149043,
                'longitude'=>115.28894916857492,
                'rating'=>4.4,
                'popularitas'=>38781,
                'deskripsi'=>'Air terjun di dekat Ubud dengan kolam alami di bawahnya, mudah dijangkau dan dikelilingi pepohonan hijau.',
                'kategori'=>['Air Terjun','Alam'],
                'fasilitas'=>['Toilet','Parkir','Warung Makan','Area Foto'],
                'gambar'=>'tegenungan-waterfall.jpg'
            ],
            [
                'nama'=>'Taman Safari Bali',
                'harga_tiket'=>225000,
                'latitude'=>-8.582213500165071,
                'longitude'=>115.34724656857624,
                'rating'=>4.5,
                'popularitas'=>24816,
                'deskripsi'=>'Taman safari di Gianyar tempat pengunjung melihat beragam satwa dari berbagai benua dari dalam kendaraan safari.',
                'kategori'=>['Satwa'],
                'fasilitas'=>['Toilet','Mushola','Parkir','Warung Makan','Area Foto'],
                'gambar'=>'taman-safari-bali.webp'
            ],
            [
                'nama'=>'Bali Zoo',
                'harga_tiket'=>140000,
                'latitude'=>-8.591908708316232,
                'longitude'=>115.2656747974107,
                'rating'=>4.5,
                'popularitas'=>29334,
                'deskripsi'=>'Kebun binatang di Singapadu yang menampilkan satwa khas Indonesia dan dunia, dilengkapi program interaksi langsung dengan satwa.',
                'kategori'=>['Satwa'],
                'fasilitas'=>['Toilet','Parkir','Warung Makan','Area Foto'],
                'gambar'=>'bali-zoo.webp'
            ],
            [
                'nama'=>'Bali Bird Park',
                'harga_tiket'=>140000,
                'latitude'=>-8.599674916088977,
                'longitude'=>115.25206762624774,
                'rating'=>4.6,
                'popularitas'=>14635,
                'deskripsi'=>'Taman burung yang menampilkan ratusan spesies burung dari Indonesia dan berbagai negara di dalam taman tropis yang rindang.',
                'kategori'=>['Satwa'],
                'fasilitas'=>['Toilet','Parkir','Warung Makan','Area Foto'],
                'gambar'=>'bali-bird-park.jpg'
            ],
            [
                'nama'=>'Sangeh Monkey Forest',
                'harga_tiket'=>15000,
                'latitude'=>-8.48183370305056,
                'longitude'=>115.20644263973922,
                'rating'=>4.6,
                'popularitas'=>9518,
                'deskripsi'=>'Hutan pala yang dihuni ratusan kera ekor panjang, dengan Pura Bukit Sari yang berdiri di tengah hutan.',
                'kategori'=>['Satwa'],
                'fasilitas'=>['Toilet','Parkir','Area Foto'],
                'gambar'=>'sangeh-monkey-forest.jpg'
            ],
            [
                'nama'=>'Gitgit Waterfall',
                'harga_tiket'=>15000,
                'latitude'=>-8.187929650251316,
                'longitude'=>115.13654009626966,
                'rating'=>4.3,
                'popularitas'=>3943,
                'deskripsi'=>'Air terjun setinggi sekitar 35 meter di jalur Singaraja–Bedugul, dikelilingi hutan tropis dan mudah dijangkau dari jalan utama.',
                'kategori'=>['Air Terjun','Alam'],
                'fasilitas'=>['Toilet','Parkir','Warung Makan'],
                'gambar'=>'gitgit-waterfall.jpg'
            ],
            [
                'nama'=>'Sekumpul Waterfall',
                'harga_tiket'=>10000,
                'latitude'=>-8.177552031345082,
                'longitude'=>115.18259322510528,
                'rating'=>4.4,
                'popularitas'=>2680,
                'deskripsi'=>'Kumpulan beberapa air terjun tinggi di lembah hijau Bali utara, sering disebut sebagai salah satu air terjun terindah di Bali.',
                'kategori'=>['Air Terjun','Alam'],
                'fasilitas'=>['Toilet','Parkir','Warung Makan'],
                'gambar'=>'sekumpul-waterfall.jpg'
            ],
            [
                'nama'=>'Nungnung Waterfall',
                'harga_tiket'=>15000,
                'latitude'=>-8.330108719959833,
                'longitude'=>115.22939046805331,
                'rating'=>4.8,
                'popularitas'=>1032,
                'deskripsi'=>'Air terjun deras di dataran tinggi Petang yang dicapai melalui ratusan anak tangga, dengan udara sejuk dan suasana hutan.',
                'kategori'=>['Air Terjun','Alam'],
                'fasilitas'=>['Toilet','Parkir','Warung Makan'],
                'gambar'=>'nungnung-waterfall.jpg'
            ],
            [
                'nama'=>'Kanto Lampo Waterfall',
                'harga_tiket'=>25000,
                'latitude'=>-8.532539221771177,
                'longitude'=>115.33287202510846,
                'rating'=>4.3,
                'popularitas'=>7925,
                'deskripsi'=>'Air terjun bertingkat di Gianyar yang mengalir di atas dinding batu, populer sebagai tempat berfoto.',
                'kategori'=>['Air Terjun','Alam'],
                'fasilitas'=>['Toilet','Parkir','Area Foto'],
                'gambar'=>'kanto-lempo-waterfall.jpg'
            ],
            [
                'nama'=>'Pantai Sanur',
                'harga_tiket'=>0,
                'latitude'=>-8.70717916027428,
                'longitude'=>115.26262240236828,
                'rating'=>4.5,
                'popularitas'=>6536,
                'deskripsi'=>'Pantai berombak tenang di pesisir timur Denpasar, terkenal dengan pemandangan matahari terbit dan jalur pejalan kaki di sepanjang pantai.',
                'kategori'=>['Pantai'],
                'fasilitas'=>['Toilet','Parkir','Warung Makan','Area Foto'],
                'gambar'=>'pantai-sanur.jpg'
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