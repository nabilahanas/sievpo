<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $table = 'data';
    protected $primaryKey = 'id_data';

    protected $fillable = [
        'id_user', 'id_bidang', 'id_shift', 'lokasi', 'tgl_waktu', 'foto', 'is_approved', 'poin',
    ];
    protected $dates = ['tgl_waktu'];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'id_bidang');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'id_shift');
    }

    // public function lokasi()
    // {
    //     return $this->belongsTo(Lokasi::class, 'id_lokasi');
    // }

}
