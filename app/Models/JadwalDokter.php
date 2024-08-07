<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JadwalDokter extends Model
{
    use HasFactory;
    protected $connection = 'simsvbaru';
    protected $table = 'jadwal';

    function poliKlinik() : HasOne {
        return $this->hasOne(Poliklinik::class, 'kd_poli', 'kd_poli');
    }
}
