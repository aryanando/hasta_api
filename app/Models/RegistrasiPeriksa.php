<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RegistrasiPeriksa extends Model
{
    use HasFactory;
    protected $connection = 'simsvbaru';
    protected $table = 'reg_periksa';

    protected $primaryKey = 'no_rawat';
    public $incrementing = false;
    protected $keyType = 'string';

    function perujuk() : HasOne {
        return $this->hasOne(RujukMasuk::class, 'no_rawat', 'no_rawat');
    }

    function pasien() : HasOne {
        return $this->hasOne(Pasien::class, 'no_rkm_medis', 'no_rkm_medis');
    }
}
