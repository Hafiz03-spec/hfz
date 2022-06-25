<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempDiagnosa extends Model
{
    use HasFactory;
    protected $table = 'temp_diagnosas';
    protected $primaryKey = 'id';
    protected $fillable = ['pasien_id','penyakit_id','gejala','gejala_terpenuhi','persen'];
}
