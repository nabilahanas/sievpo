<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengumuman extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pengumuman';
    protected $primaryKey = 'id_pengumuman';

    protected $fillable = [
        'judul',
        'gambar',
        'deskripsi',
        'tgl_publikasi',
    ];

    public function deleteImage()
    {
        if ($this->gambar && file_exists(public_path('gambar-pengumuman/' . $this->gambar))) {
            // Hapus file gambar dari direktori
            unlink(public_path('gambar-pengumuman/' . $this->gambar));
        }
    }
    public $timestamps = true;
}
