<?php

namespace App\Models\simrs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PeriksaLab extends Model
{
    use HasFactory;
    protected $connection = 'simsvbaru';
    protected $table = 'periksa_lab';
    // protected $primaryKey = 'no_resep';
    public $incrementing = false;
    // protected $keyType = 'string';

    function dataJenisPerawatanLab() : HasOne {
        return $this->hasOne(JenisPerawatanLab::class, 'kd_jenis_prw', 'kd_jenis_prw');
    }
    function dataDetailPeriksaLab() : HasMany {
        return $this->hasMany(DetailPeriksaLab::class, 'no_rawat', 'no_rawat');
    }
}
