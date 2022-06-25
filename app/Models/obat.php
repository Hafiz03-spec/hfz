<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class obat extends Model
{
    use HasFactory;
    protected $table = 'obats';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_obat'];

    // public function obat(){
    //     return $this->belongsTo(penyakit::class,'obat_id');
    // }

}
