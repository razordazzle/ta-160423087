<?php
namespace App\Services;

use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeocodingService{
    // jenis tempat yg dianggap cukup spesifik utk jd lokasi awal (dipake geocode & saranLokasi)
    private const TIPE_VALID=['lodging','establishment','point_of_interest','premise','street_address'];

    /**
     * konversi nama lokasi jadi koordinat via GMaps Geocoding API. null kl gaditemukan
     * $placeId diisi kl user pilih saran dropdown (lebih tepat dari text)
     */
    public function geocode(string $alamat,?string $placeId=null):?array{
        $parameter=$placeId!==null?['place_id'=>$placeId]:['address'=>$alamat.', Bali, Indonesia'];
        $parameter['key']=config('services.google_maps.key');

        $response=Http::get('https://maps.googleapis.com/maps/api/geocode/json',$parameter);

        $data=$response->json();

        if($data['status']!=='OK'||empty($data['results'])) return null;

        $hasil=$data['results'][0];
        $types=$hasil['types'] ?? [];

        // saran dropdown sdh difilter tipe nya di saranLokasi, jd cek tipe cuma utk text bebas
        if($placeId===null && empty(array_intersect($types,self::TIPE_VALID))) return null;
        
        return [
            'latitude'=>$hasil['geometry']['location']['lat'],
            'longitude'=>$hasil['geometry']['location']['lng']
        ];
    }

    // saran lokasi utk dropdown via Places API, dibatasi di pulai Bali. kosong kl gagal
    public function saranLokasi(string $input):array{
        try{
            $response=Http::timeout(5)
                ->withHeaders(['X-Goog-Api-Key'=>config('services.google_maps.places_key')])
                ->post('https://places.googleapis.com/v1/places:autocomplete',[
                    'input'=>$input,
                    'languageCode'=>'id',
                    'locationRestriction'=>[
                        'rectangle'=>[
                            'low'=>['latitude'=>-8.9,'longitude'=>114.40],
                            'high'=>['latitude'=>-8.05,'longitude'=>115.75]
                        ]
                    ]
                ]);
        }catch(ConnectException $e){
            Log::warning('Places Autocomplete tidak terjangkau',['pesan'=>$e->getMessage()]);
            return [];
        }

        if($response->failed()){
            Log::warning('Places Autocomplete gagal',['status'=>$response->status(),'body'=>$response->body()]);
            return [];
        }

        $saran=[];
        foreach($response->json('suggestions',[]) as $item){
            $p=$item['placePrediction']??null; // queryPrediction gapunya placeId, dilewati

            if($p===null || empty(array_intersect($p['types'] ?? [],self::TIPE_VALID))) continue;

            $saran[]=[
                'place_id'=>$p['placeId'],
                'utama'=>$p['structuredFormat']['mainText']['text'] ?? $p['text']['text'],
                'keterangan'=>$p['structuredFormat']['secondaryText']['text'] ?? ''
            ];
        }

        return $saran;
    }
}
?>