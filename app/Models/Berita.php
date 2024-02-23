<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;

class Berita extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'berita';
    protected $primaryKey = 'id_berita';

    protected $fillable = [
        'judul',
        'gambar',
        'deskripsi',
        'tgl_publikasi',
    ];

    public function deleteImage()
    {
        if ($this->gambar && file_exists(public_path('gambar-berita/' . $this->gambar))) {
            // Hapus file gambar dari direktori
            unlink(public_path('gambar-berita/' . $this->gambar));
        }
    }

    public $timestamps = true;
}
