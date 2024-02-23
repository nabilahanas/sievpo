<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lokasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lokasi';

    protected $primaryKey = 'id_lokasi';

    protected $fillable = [
        'nama_lokasi',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'latitude' => 'double',
        'longitude' => 'double',
    ];

    public $timestamps = true;
}
