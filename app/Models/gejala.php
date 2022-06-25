<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gejala extends Model
{
    use HasFactory;
    protected $table = 'gejalas';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_gejala'];

}
