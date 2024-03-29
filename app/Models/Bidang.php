<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bidang extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bidang';

    protected $primaryKey = 'id_bidang';

    protected $fillable = [
        'nama_bidang', 'deskripsi',
    ];

    public $timestamps = true;
}
