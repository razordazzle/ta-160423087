<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeocodingService{
    // konversi nama lokasi jadi koordinat via GMaps Geocoding API. null kl gaditemukan
    public function geocode(string $alamat):?array{
        $response=Http::get('https://maps.googleapis.com/maps/api/geocode/json',[
            'address'=>$alamat.', Bali, Indonesia',
            'key'=>config('services.google_maps.key')
        ]);

        $data=$response->json();

        if($data['status']!=='OK'||empty($data['results'])) return null;

        $hasil=$data['results'][0];
        $types=$hasil['types'] ?? [];

        $tipeValid=['lodging','establishment','point_of_interest','premise','street_addreess'];
        if(empty(array_intersect($types,$tipeValid)))
            return null;
        
        return [
            'latitude'=>$hasil['geometry']['location']['lat'],
            'longitude'=>$hasil['geometry']['location']['lng']
        ];
    }
}
?>