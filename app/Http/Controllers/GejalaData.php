<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\penyakit;
use App\Models\gejala;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class GejalaData extends Controller
{
    //
    public function gejala(){

        $gejala= gejala::latest()->paginate(5);
        Paginator::useBootstrap();
        return view('appView.gejala',compact('gejala'));
    }

    public function addGejala(){
        return view('appAdd.gejala');
    }

    public function saveGejala(Request $request){
        $request->validate([
            "nama" => "required",
        ]);

        $gejala = new gejala();
        $gejala->nama_gejala =$request->nama;
        $gejala->save();
        return redirect('/gejala')->with('success','Penyakit Berhasil di Tambahkan');

    }

    public function editGejala(Request $request,$id){
        $gejala=gejala::find($id);
        return view('appEdit.gejala',compact('gejala'));
    }


    public function saveEditGejala(Request $request,$id){
        $request->validate([
            "nama" => "required",
        ]);

        $gejala = gejala::find($id);
        $gejala->nama_gejala =$request->nama;
        $gejala->update();
        return redirect('/gejala')->with('success','Gejala Berhasil diupdate');

    }

    public function deleteGejala(Request $request,$id){
        $gejala = gejala::find($id);
        $gejala->delete();
        return redirect('/gejala')->with('success','Gejala Berhasil dihapus');

    }
}