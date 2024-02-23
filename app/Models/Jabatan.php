<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jabatan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jabatan';
    protected $primaryKey = 'id_jabatan';
    
    protected $fillable = [
        'nama_jabatan',
        'wilayah',
        'bagian',
        'klasifikasi',
    ];

    public $timestamps = true;
}
