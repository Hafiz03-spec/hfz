<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\diagnosaController;
use App\Http\Controllers\diagnosaPasien;
use App\Http\Controllers\Login;
use App\Http\Controllers\PenyakitData;
use App\Http\Controllers\GejalaData;
use App\Http\Controllers\RuleData;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/h', function () {
    return view('layoutUtama.dashboard');
});

Route::get('la',[Login::class,'tes'])->name('tes111');





Route::get('/',[diagnosaController::class,'pakar'])->name('pakar');
Route::get('diagnostic-data/',[diagnosaController::class,'gejalaView'])->name('submit-dataa');

Route::get('/p',[diagnosaController::class,'gejala2'])->name('diagnosa2');



//Route::post('submit-datas/{id}',[diagnosaController::class,'gejala3'])->name('submit');
//Route::post('diagnosass',[diagnosaController::class,'gejalaViews'])->name('diagnosa');
Route::post('diagnosasd',[diagnosaController::class,'gejalaViewz'])->name('diagnosa');

//=====================================================================================================================================

Route::get('/login',[Login::class,'login'])->name('login');
Route::get('/logout',[Login::class,'logout'])->name('user-logout');
Route::post('/registered',[Login::class,'user_register'])->name('proces-register');
Route::get('/registers',[Login::class,'register'])->name('register');
//Route::get('/pakar',[diagnosaController::class,'pakar'])->name('pakar');
Route::post('/proses-login',[Login::class,'proses_login'])->name('proses-login');

Route::group(['midlleware'=>['auth']],function(){
    Route::group(['middleware'=>['cek_login']],function(){
    Route::get('/dashboard',[PenyakitData::class,'Dsh'])->name('dashboard');
    Route::get('/penyakit',[PenyakitData::class,'penyakit'])->name('data-penyakit');
    Route::get('/penyakit-add',[PenyakitData::class,'addPenyakit'])->name('add-penyakit');
    Route::post('/penyakit-save',[PenyakitData::class,'savePenyakit'])->name('save-penyakit');
    Route::get('/penyakit-edit/{id}/',[PenyakitData::class,'editPenyakit'])->name('edit-penyakit');
    Route::post('/penyakit-save-edit/{id}/',[PenyakitData::class,'saveEditPenyakit'])->name('save-edit-penyakit');
    Route::get('/penyakit-delete/{id}/',[PenyakitData::class,'deletePenyakit'])->name('delete-penyakit');


    Route::get('/gejala',[GejalaData::class,'gejala'])->name('data-gejala');
    Route::get('/gejala-add',[GejalaData::class,'addGejala'])->name('add-gejala');
    Route::post('/gejala-save',[GejalaData::class,'saveGejala'])->name('save-gejala');
    Route::get('/gejala-edit/{id}/',[GejalaData::class,'editGejala'])->name('edit-gejala');
    Route::post('/gejala-save-edit/{id}',[GejalaData::class,'saveEditGejala'])->name('save-edit-gejala');
    Route::get('/gejala-delete{id}',[GejalaData::class,'deleteGejala'])->name('delete-gejala');

    
    Route::get('/rule-add',[RuleData::class,'addRule'])->name('add-rule');
    Route::post('/rule-save',[RuleData::class,'saveRule'])->name('save-rule');
    Route::get('/rule',[RuleData::class,'rule'])->name('data-rule');
    Route::get('/{id}/rule-edit',[RuleData::class,'editRule'])->name('edit-rule');
    Route::post('/rule-save-edit/{id}',[RuleData::class,'saveEditRule'])->name('save-edit-rule');
    Route::get('/rule-delete',[RuleData::class,'deleteRule'])->name('delete-rule');


    //=====================================================================================================================================
    Route::get('/diagnosa',[diagnosaPasien::class,'diagnosa'])->name('data-penyakit');
    Route::post('/deleteDiagnosa/{id}',[diagnosaController::class,'deleted'])->name('delete-diagnosa');
    });
  
});
