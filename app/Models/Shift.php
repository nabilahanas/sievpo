<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shift extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'shift';

    protected $primaryKey = 'id_shift';

    protected $fillable = [
        'nama_shift',
        'jam_mulai',
        'jam_akhir',
        'poin',
    ];

    public $timestamps = true;
}
