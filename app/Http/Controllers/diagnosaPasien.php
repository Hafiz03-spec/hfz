<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\diagnosa;
use App\Models\TempDiagnosa;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class diagnosaPasien extends Controller
{
    //
    public function diagnosa(){
        $data_update=DB::Table('temp_diagnosas')->where('pasien_id',auth()->user()->id)->where('status',0)->get();
        
        foreach($data_update as $datainsert){
            if($datainsert->persen > 50){
                $insert_data= new diagnosa();
                $insert_data->id_pasien=$datainsert->pasien_id;
                $insert_data->id_penyakit=$datainsert->penyakit_id;
                $insert_data->persentase_Terkena=$datainsert->persen;
                $insert_data->tanggal=$datainsert->created_at;
                $insert_data->save();
            }

            $update=TempDiagnosa::find($datainsert->id);
            $update->status =1;
            $update->update();
        }
        date_default_timezone_set("Asia/Makassar");
        $time = date("y-m-d");

        $data =diagnosa::latest()->join('penyakits','penyakits.id','=','diagnosa.id_penyakit')
		->join('users','users.id','=','diagnosa.id_pasien')->where('diagnosa.id_pasien',auth()->user()->id)->select('diagnosa.*','penyakits.nama_penyakit','users.name')->paginate(5);
        Paginator::useBootstrap();

        $data_delete=DB::Table('temp_diagnosas')->where('pasien_id',auth()->user()->id)->value('id');
        return view('AppDiagnosa.diagnosa',compact('data','time'));
    }
}
