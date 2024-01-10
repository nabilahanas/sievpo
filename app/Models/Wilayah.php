<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
        use HasFactory;
    
        protected $table = 'wilayah'; // Assuming your table name is 'wilayah'
        protected $primaryKey = 'id_wilayah'; // Assuming your primary key is 'id'
    
        // Fillable fields for mass assignment
        protected $fillable = [
            'nama_wilayah',
            'latitude',
            'longitude',
            'deskripsi',
            // Add other fields as needed
        ];
    
        // Timestamps
        public $timestamps = true; // If your table has created_at and updated_at columns
}
