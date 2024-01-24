<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;
    protected $table = 'pengumuman';
    protected $primaryKey = 'id_pengumuman';

    protected $fillable = [
        'judul',
        'gambar',
        'deskripsi',
        'tgl_publikasi',
    ];

    public $timestamps = true;
}