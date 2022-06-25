<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\gejala;
use App\Models\penyakit;
use App\Models\rule;
use App\Models\User;
use App\Models\TempDiagnosa;
use App\Models\diagnosa;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class diagnosaController extends Controller
{
	public function pakar(){
		$penyakit=DB::Table('penyakits')
		->select(DB::raw("count(id) as jumlah"))
		->orderBy('jumlah','DESC')->value('jumlah');

		$gejala=DB::Table('gejalas')
		->select(DB::raw("count(id) as jumlah"))
		->orderBy('jumlah','DESC')->value('jumlah');

		$user=DB::Table('users')
		->select(DB::raw("count(id) as jumlah"))
		->orderBy('jumlah','DESC')->value('jumlah');

		return view('layoutUtama.portal',compact('penyakit','gejala','user'));
	}

	// public function dashboard(){
	// 	$penyakit=DB::Table('penyakits')
	// 	->select(DB::raw("count(id) as jumlah"))
	// 	->orderBy('jumlah','DESC')->value('jumlah');

	// 	$gejala=DB::Table('gejalas')
	// 	->select(DB::raw("count(id) as jumlah"))
	// 	->orderBy('jumlah','DESC')->value('jumlah');

	// 	$user=DB::Table('users')
	// 	->select(DB::raw("count(id) as jumlah"))
	// 	->orderBy('jumlah','DESC')->value('jumlah');

	// 	return view('layoutUtama.dashboard',compact('penyakit','gejala','user'));
	// }

	public function gejala2(){
		$gejalas=DB::Table('gejalas')->get();
		$pasien_id=DB::Table('users')->where('id',auth()->user()->id)->value('id');
		return view('prediagnostic2',compact('pasien_id','gejalas'));
	}
    
	public function gejalaViewz(Request $request){
		
		$temp=0;
		$z=0;
		$data = count($request->gejala);
		// dd($request->all());
		
		for($i=0; $i<$data; $i++){ //request semua gejala
			// echo 'gejala nilai'.$request->gejala[$i]."<br>";


			if($request->gejala[$i] != 100){ //nilainya tidak sama dengan null
				
				$k=$i+1;
				//echo 'penyakit ke'.$i.'<br>';
				for($j=1; $j<=13; $j++){
					$gejj= DB::Table('gejalas')->where('id',$k)->first();
					$datas = DB::Table('rules')->where('id_gejala',$gejj->id)->where('id_penyakit',$j)->first();
					

					if($datas){

						$temp_diagnosa = TempDiagnosa::where('pasien_id',auth()->user()->id)->where('status',0)->where('penyakit_id', $datas->id_penyakit);
						$temp_diag = $temp_diagnosa->first();
						if (!$temp_diag){
							
							$temp_diag = new TempDiagnosa;
							$temp_diag->pasien_id = Auth()->user()->id; //isi
							$temp_diag->penyakit_id = $datas->id_penyakit; //isi
							$temp_diag->gejala = $datas->id_gejala; //isi
							$temp_diag->gejala_terpenuhi = 1;
							$temp_diag->persen = 0;
							$temp_diag->status = 0;
							$temp_diag->save();
						}else{
							// echo 'terpenuhi';
							$temp_diag = TempDiagnosa::find($temp_diag->id);
							$temp_diag->gejala_terpenuhi = $temp_diag->gejala_terpenuhi + 1;
							$temp_diag->update();
						}
					
					}
				}  
		 	}
		}


		
		$data_penyakit = TempDiagnosa::where('pasien_id',auth()->user()->id)->where('status',0)->orderBy('gejala_terpenuhi','DESC','LIMIT','2')->get();
		//echo $data_penyakit;
		
		foreach($data_penyakit as $terkena){
			$persentase=0;
			$cf_hasil=[];
			$cf_k=[];
			$flag=0;
			
			$z=0;
			for($i=0; $i<$data; $i++){
				//echo $request->gejala[$i]."<br>";
				$cf_final= 0;
				$k=$i+1;
				if($request->gejala[$i] !=100){ //kondisi untuk mengambil semua gejala yang dialami , setiap gejala memiliki nilai cf user yaitu kisaran (0-)
					
					$gejj= DB::Table('gejalas')->where('id',$k)->value('id');
					$datas = DB::Table('rules')->where('id_gejala',$gejj)->where('id_penyakit',$terkena->penyakit_id)->first();
			
					if($datas){
						$cf_hasil[$z]= $request->gejala[$i] * $datas->cf; 
						$flag= $flag +1;
						$z= $z+1;
					
					}
					
					
				}

			}
			
			if($flag >1){
				$x=1;
				
				for($j=0; $j<$flag-1; $j++){ //flag = gejala jika ada 4 gejala (1,2,3,4) maka terdapat 3 proses perhitungan (cf1 , cf2 , (cfk1, cf3), (cfk2,cf4))
					if($j==0){
						// j == gejala yang dialami yang telah memenuhi salah satu penyakit
						//flag == jumlah gejala yang dialami
						//cf_k == kombinasi nilai cf dimulai dari 1
						//cf_hasil == nilai cf dari pakar yang telah dikalikan dengan nilai cf user
						//cf_k[x] = kombinasi nilai cf pada index ke x
						//cf_hasil[j] = gejala yang dialami pada index ke j 

						if($cf_hasil[$j] && $cf_hasil[$j+1] > 0 ){ //jika gejala 1 dan 2 bernilai lebih dari  0
							$cf_k[$x] = $cf_hasil[$j] + ($cf_hasil[$j+1] * (1-$cf_hasil[$j]));
							// echo $cf_k[$x];
							// echo "<br>";
						}elseif($cf_hasil[$j] && $cf_hasil[$j+1] < 0 ){ //jika gejala 1 dan 2 kurang dari 0
							$cf_k[$x] = $cf_hasil[$j] + ($cf_hasil[$j+1] * (1+$cf_hasil[$j]));
						}else{ // jika salah satu gejala bernilai negatif
							if($cf_hasil[$j]<$cf_hasil[$j+1]){ //jika gejala 1 lebih kecil dari gejala 2
								$cf_k[$x] = $cf_hasil[$j] + ($cf_hasil[$j+1] / (1- ($cf_hasil[$j])));
							}elseif($cf_hasil[$j+1]<$cf_hasil[$j]){ //jika gejala 2 lebih kecil dari gejala 1
								$cf_k[$x] = $cf_hasil[$j] + ($cf_hasil[$j+1] / (1- ($cf_hasil[$j+1])));
							}
						}
							
					}elseif($j == $flag-1){
						if($cf_k[$x-1] && $cf_hasil[$j+1] > 0){//jika hasil kommbinasi dan gejala bernilai positif
							$cf_k[$x] = $cf_k[$x-1] + ($cf_hasil[$j+1]  * (1- $cf_k[$x-1]));
							// echo $cf_k[$x];
							// echo "<br>";
						}elseif($cf_hasil[$x-1] && $cf_hasil[$j+1] < 0 ){
							$cf_k[$x] = $cf_k[$x-1] + ($cf_hasil[$j+1]  * (1+ $cf_k[$x-1]));
						}else{
							if($cf_k[$x-1] < $cf_hasil[$j+1]){ //jika gejala 1 lebih kecil dari gejala 2
								$cf_k[$x] = $cf_k[$x-1] + ($cf_hasil[$j+1] / (1- ($cf_k[$x-1])));
							}elseif($cf_hasil[$j+1]< $cf_hasil[$x-1]){ //jika gejala 2 lebih kecil dari gejala 1
								$cf_k[$x] = $cf_k[$x-1] + ($cf_hasil[$j+1] / (1- ($cf_hasil[$j+1])));
							}
						}
						
					}else{
						if($cf_k[$x-1] && $cf_hasil[$j+1] > 0){//jika hasil kommbinasi dan gejala bernilai positif
							$cf_k[$x] = $cf_k[$x-1] + ($cf_hasil[$j+1]  * (1- $cf_k[$x-1]));
							// echo $cf_k[$x];
							// echo "<br>";
						}elseif($cf_hasil[$x-1] && $cf_hasil[$j+1] < 0 ){
							$cf_k[$x] = $cf_k[$x-1] + ($cf_hasil[$j+1]  * (1+ $cf_k[$x-1]));
						}else{
							if($cf_k[$x-1] < $cf_hasil[$j+1]){ //jika gejala 1 lebih kecil dari gejala 2
								$cf_k[$x] = $cf_k[$x-1] + ($cf_hasil[$j+1] / (1- ($cf_k[$x-1])));
							}elseif($cf_hasil[$j+1]< $cf_hasil[$x-1]){ //jika gejala 2 lebih kecil dari gejala 1
								$cf_k[$x] = $cf_k[$x-1] + ($cf_hasil[$j+1] / (1- ($cf_hasil[$j+1])));
							}
						}
						//$cf_k[$x] = $cf_k[$x-1] + ($cf_hasil[$j+1]  * (1- $cf_k[$x-1]));
						//echo $cf_k[$x] = $cf_k[$x-1] + ($cf_hasil[$j+1]  * (1- $cf_k[$x-1]));
					
					}

					
						$x++;
				}
				$cf_final = $cf_k[$flag-1];
				($cf_final);
			}
			
		$persentase = $cf_final * 100;
		//dd($persentase);
		// echo $persentase."<br>";
	
		$data_update_temp=DB::Table('temp_diagnosas')->join('users','users.id','=','temp_diagnosas.pasien_id')
		->where('temp_diagnosas.pasien_id',auth()->user()->id)->where('penyakit_id',$terkena->penyakit_id)->where('status',0)->value('temp_diagnosas.id');
		$data_update_temp2=TempDiagnosa::find($data_update_temp);
		$data_update_temp2->persen = $persentase;
		$data_update_temp2->update();
	
	
	}
	
	
		$data_sementara = DB::Table('temp_diagnosas')->join('penyakits','penyakits.id','=','temp_diagnosas.penyakit_id')
		->join('users','users.id','=','temp_diagnosas.pasien_id')->where('temp_diagnosas.status',0)->select('temp_diagnosas.*','penyakits.nama_penyakit','users.name')->where('temp_diagnosas.pasien_id',$request->pasien_id)->where('temp_diagnosas.persen','>',50)
		->orderBy('temp_diagnosas.persen','DESC')
		->get();

		// $data_delete = DB::Table('temp_diagnosas')->where('pasien_id',$request->pasien_id);
		// $data_delete->delete();

		

		return view('AppDiagnosa.diagnosaTemp',compact('data_sementara'));
		// echo 'persentase terkena = '.$persentase.'%';
		// echo '<br>';
		// echo 'penyakit_id ='.$data_penyakit;
		//$penyakit_detect = DB::Table('rule')->where('id_penyakit',$data_penyakit);
	}

	public function deleted($id){
		$gejala = diagnosa::find($id);
        $gejala->delete();
        return redirect('/diagnosa');
	}
}

