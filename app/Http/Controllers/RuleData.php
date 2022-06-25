<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penyakit;
use App\Models\gejala;
use App\Models\rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class RuleData extends Controller
{
    //
    public function rule(){
        $rule= rule::join('penyakits','rules.id_penyakit','=','penyakits.id')->join('gejalas','gejalas.id','rules.id_gejala')
        ->select('rules.*','gejalas.nama_gejala','penyakits.nama_penyakit')->orderBy('rules.created_at','asc')->paginate(5);
        Paginator::useBootstrap();
        return view('appView.rule',compact('rule'));
    }

    public function addRule(Request $request){
        $penyakit = penyakit::all();

        $gejala = gejala::all();
        return view('appAdd.rule',compact('penyakit','gejala'));
    }

    public function saveRule(Request $request){
      
        $request->validate([
            "id_penyakit" => "required",
            "id_gejala" => "required",
            "nilai_cf" => "required"
        ]);

        $rule = new rule();
        $rule->id_penyakit =$request->id_penyakit;
        $rule->id_gejala = $request->id_gejala;
        $rule->cf = $request->nilai_cf;
        $rule->save();
        return redirect('/rule')->with('success','Aturan Berhasil di Tambahkan');

    }

    public function editRule(Request $request,$id){
        $rule=rule::find($id);

        $penyakit = penyakit::all();

        $gejala = gejala::all();
        return view('appEdit.rule',compact('penyakit','gejala','rule'));
    }


    public function saveEditRule(Request $request,$id){
  
        $request->validate([
            "id_penyakit" => "required",
            "id_gejala" => "required",
            "nilai_cf" =>"required|numeric"
        ]);

        $rule = rule::find($id);
        $rule->id_penyakit =$request->id_penyakit;
        $rule->id_gejala = $request->id_gejala;
        $rule->cf = $request->nilai_cf;
        $rule->update();

        return redirect('/rule')->with('success','Aturan Berhasil diupdate');

    }

    public function deleteRule(Request $request,$id){

        $rule = rule::find($id);
        $rule->delete();
        return redirect('/rule')->with('success','Aturan Berhasil dihapus');
    }
}
