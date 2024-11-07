<?php

namespace App\Models\simrs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DetailPeriksaLab extends Model
{
    use HasFactory;
    protected $connection = 'simsvbaru';
    protected $table = 'detail_periksa_lab';
    // protected $primaryKey = 'no_resep';
    public $incrementing = false;
    // protected $keyType = 'string';

    function dataTemplateLaboratorium() : HasOne {
        return $this->hasOne(TemplateLaboratorium::class, 'id_template', 'id_template');
    }

    function dataJenisPerawatanLab() : HasOne {
        return $this->hasOne(JenisPerawatanLab::class, 'kd_jenis_prw', 'kd_jenis_prw');
    }
}
