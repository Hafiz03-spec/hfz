<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class diagnosa extends Model
{
    use HasFactory;
    protected $table="diagnosa";
    protected $primaryKey = 'id';
    protected $fillable = ['id_pasien','id_penyakit','tanggal'];

}
