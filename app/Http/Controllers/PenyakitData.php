<?php

namespace App\Http\Controllers;

use App\Models\diagnosa;
use Illuminate\Http\Request;
use App\Models\penyakit;
use App\Models\gejala;
use App\Models\rule;
use App\Models\obat;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class PenyakitData extends Controller
{
    //
    public function Dsh(){
        $penyakit= penyakit::all();
        $gejala= gejala::all();
        $rule= rule::all();
        $diagnosa= diagnosa::where('id_pasien',auth()->user()->id);

        return view('layoutUtama.dashboard',compact('penyakit','gejala','rule','diagnosa'));
    }
    public function penyakit(){
        $penyakit= penyakit::join('obats','obats.id','=','penyakits.id_obat')
        ->select('penyakits.*','obats.nama_obat')->orderBy('penyakits.created_at','asc')->paginate(5);
        Paginator::useBootstrap();
        return view('appView.penyakit',compact('penyakit'));
    }

    public function addPenyakit(Request $request){
        $obat =obat::all();
        return view('appAdd.penyakit',compact('obat'));
    }

    public function savePenyakit(Request $request){
        $request->validate([
            "nama" => "required",
            "penyebab" =>"required",
            "obat_id" => "required"
        ]);

        $penyakit = new penyakit();
        $penyakit->nama_penyakit =$request->nama;
        $penyakit->penyebab =$request->penyebab;
        $penyakit->id_obat = $request->obat_id;
        $penyakit->save();
        return redirect('/penyakit')->with('success','Penyakit Berhasil di Tambahkan');
    }

    public function editPenyakit($id){
        $penyakit=penyakit::find($id);

        $obat =obat::all();

        
        return view('appEdit.penyakit',compact('obat','penyakit'));
    }


    public function saveEditPenyakit(Request $request,$id){
        $request->validate([
            "nama" => "required",
            "penyebab" =>"required",
            "obat_id" => "required"
        ]);

        $penyakit = penyakit::find($id);
        $penyakit->nama_penyakit =$request->nama;
        $penyakit->penyebab =$request->penyebab;
        $penyakit->id_obat = $request->obat_id;
        $penyakit->update();

        return redirect('/penyakit')->with('success','Penyakit Berhasil diupdate');

    }

    public function deletePenyakit(Request $request,$id){
        $penyakit = penyakit::find($id);
        $penyakit->delete();
        return redirect('/penyakit')->with('success','Penyakit Berhasil dihapus');
    }
}



    
