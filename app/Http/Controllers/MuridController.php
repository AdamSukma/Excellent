<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mapel;
use App\Models\Soal;
use Auth;
use Hash;

class MuridController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function viewJadwal()
    {
        return view('murid.viewJadwal');
       
    }
    public function viewProfile()
    {
        return view('murid.viewProfile');
       
    }
    public function viewSoal()
    {
        $soal = Soal::all();
        return view('murid.viewSoal')->with('soal',$soal);
    }
    public function updateProfile(Request $request){
        $murid = AUTH::user();
        $this->validate($request,[
            'password' => 'required|min:8',
            'repassword' => 'required_with:password|same:password||min:8'
        ]);
        $murid->password = Hash::make($request->password);
        $murid->save();
        return back()->with('success',"Password berhasil diubah");
    }

    public function addSoal(){
        $mapel = Mapel::all();
        return view('murid.addSoal',['mapel'=>$mapel],compact('mapel'));
    }
}
