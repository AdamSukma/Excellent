<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapel;
use App\Models\Soal;
use App\Models\Jadwal;
use Validator;
use File;
use Auth;
use Illuminate\Support\Facades\Storage;

class JadwalController extends Controller
{
    public function store(Request $request)
    {
        $mapel = Mapel::find($request->id_mapel);
        $this->validate($request, [
            'soal' => 'mimes:pdf,doc,docx,pptx',
            'materi' =>'required',
            'tanggal' =>'required',
            'sesi' =>'required',
        ]);
        if($request->id_guru==0){
            return back()->withErrors('Pengajar harus dipilih');
        }
        if($request->id_mapel==0){
            return back()->withErrors('Mata Pelajaran harus dipilih');
        }
        if($request->sesi==0){
            return back()->withErrors('Sesi harus dipilih');
        }
        $soal = new Soal;
        $jadwal = new Jadwal();
        if (!is_null($request->soal)) {
            $file =  $request->file('soal');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->materi . '_' . $mapel->nama . '_' . date("Y-m-dTHis") . "." . $extension;
            $path = $file->storeAs('private/soal', $filename);
            $soal->file = $filename;
            $soal->judul = $request->materi;
            $soal->tgl_buat = date("Ymd");
            $soal->id_mapel = $request->id_mapel;
            $soal->save();
            $jadwal->id_soal = $soal->id;
        }
        $jadwal->tanggal = $request->tanggal;
        $jadwal->sesi = $request->sesi;
        $jadwal->id_guru = $request->id_guru;
        $jadwal->id_mapel = $request->id_mapel;
        $jadwal->id_murid = Auth::user()->id;
        $jadwal->status = 0;
        $jadwal->save();
        return redirect()->route('murid.jadwal')->withSuccess('Penambahan Jadwal Berhasil');
    }
}