<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poin extends Model
{
    use HasFactory;

    protected $table = 'poin';
    protected $primaryKey = 'id_poin';
    protected $fillable = [
        'poin_1_11', 'poin_1_12', 'poin_1_13', 'poin_1_14', 'poin_1_15', 'poin_1_16', 'poin_1_17', 'poin_1_18',
        'poin_1_11', 'poin_1_12', 'poin_2_13', 'poin_2_14', 'poin_2_15', 'poin_2_16', 'poin_2_17', 'poin_2_18',
        'poin_1_11', 'poin_1_12', 'poin_3_13', 'poin_3_14', 'poin_3_15', 'poin_3_16', 'poin_3_17', 'poin_3_18',
        'poin_1_11', 'poin_1_12', 'poin_4_13', 'poin_4_14', 'poin_4_15', 'poin_4_16', 'poin_4_17', 'poin_4_18',
    ];

    public $timestamp = true; 
}
