<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
        use HasFactory;
    
        protected $table = 'wilayah';
        protected $primaryKey = 'id_wilayah';
    
        protected $fillable = [
            'nama_wilayah',
            'latitude',
            'longitude',
            'deskripsi',
        ];

        public $timestamps = true; // If your table has created_at and updated_at columns
}
