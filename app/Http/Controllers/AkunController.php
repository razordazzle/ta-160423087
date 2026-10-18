<?php
namespace App\Http\Controllers;

use App\Models\Pencarian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AkunController extends Controller{
    public function index(Request $request){
        $user=User::find(session('id_user'));
        $sudahLogin=$user->email!==null;

        $riwayat=Pencarian::where('id_user',$user->id_user)
            ->whereHas('hasilRekomendasi')
            ->with('hasilRekomendasi')
            ->orderByDesc('id_pencarian')
            ->take(20)
            ->get();

        foreach($riwayat as $pencarian){
            $pencarian->setRelation('teratas',$pencarian->hasilRekomendasi->sortByDesc('pivot.nilai_preferensi')->first());
        }

        $tab=$request->query('tab');
        if(!in_array($tab,['akun','riwayat'],true)) $tab=$sudahLogin?'akun':'riwayat';

        return view('akun.index',compact('user','sudahLogin','riwayat','tab'));
    }

    public function update(Request $request){
        $user=User::find(session('id_user'));
        if($user->email===null) return redirect()->route('akun.index');

        $request->validate([
            'email'=>['required','email',Rule::unique('user','email')->ignore($user->id_user,'id_user')],
            'password_lama'=>'required',
            'password'=>'nullable|min:8|confirmed'
        ]);

        if(!Hash::check($request->password_lama,$user->password))
            return back()->withErrors(['password_lama'=>'Password saat ini salah'])->withInput($request->only('email'));

        $data=['email'=>$request->email];
        if($request->filled('password')) $data['password']=Hash::make($request->password);
        $user->update($data);

        return redirect()->route('akun.index')->with('pesan','Data akun berhasil diperbarui');
    }

    public function bukaRiwayat(Pencarian $pencarian){
        abort_unless($pencarian->id_user===session('id_user'),404);
        abort_unless($pencarian->hasilRekomendasi()->exists(),404);

        session(['id_pencarian'=>$pencarian->id_pencarian]);

        return redirect()->route('cari-rekomendasi.hasil',['dari'=>'akun']);
    }
}
?>