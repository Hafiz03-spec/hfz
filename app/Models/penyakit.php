<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penyakit extends Model
{
    use HasFactory;
    protected $table = 'penyakits';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_penyakit','id_obat'];

//     public function obat(){
//         return $this->hasMany(obat::class,'obat_id');
//     }
}
