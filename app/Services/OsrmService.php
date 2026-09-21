<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class OsrmService{
    private const BASE_URL='https://router.project-osrm.org';

    // hitung urutan kunjungan optimal via osrm trip service (subbab 2.7)
    public function hitungRute(array $lokasiAwal,$destinasiList):?array{
        $destinasiArray=collect($destinasiList)->values()->all();

        $koordinat=[$lokasiAwal['longitude'].','.$lokasiAwal['latitude']];
        foreach($destinasiArray as $d){
            $koordinat[]=$d->longitude.','.$d->latitude;
        }
        $koordinatString=implode(';',$koordinat);

        $response=Http::get(self::BASE_URL."/trip/v1/driving/{$koordinatString}",[
            'roundtrip'=>'false',
            'source'=>'first',
            'destination'=>'any',
            'overview'=>'false'
        ]);

        $data=$response->json();

        if(($data['code'] ?? null) !== 'Ok') return null;

        $waypoints=$data['waypoints'];
        $legs=$data['trips'][0]['legs'] ?? [];

        $urutan=[];
        foreach($destinasiArray as $i=>$destinasi){
            $urutan[]=[
                'destinasi'=>$destinasi,
                'urutan_ke'=>$waypoints[$i+1]['waypoint_index']
            ];
        }
        usort($urutan,fn($a,$b)=>$a['urutan_ke']<=>$b['urutan_ke']);

        foreach($urutan as $index=>&$item){
            $item['jarak_dari_sebelumnya_km']=isset($legs[$index]) ? $legs[$index]['distance']/1000:null;
        }

        return [
            'urutan'=>$urutan,
            'total_jarak_km'=>($data['trips'][0]['distance'] ?? 0)/1000,
            'total_durasi_menit'=>($data['trips'][0]['duration'] ?? 0)/60
        ];
    }
}
?>