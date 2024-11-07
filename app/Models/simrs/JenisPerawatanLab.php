<?php

namespace App\Models\simrs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisPerawatanLab extends Model
{
    use HasFactory;
    protected $connection = 'simsvbaru';
    protected $table = 'jns_perawatan_lab';
    protected $primaryKey = 'kd_jenis_prw';
    public $incrementing = false;
    protected $keyType = 'string';

    function dataDetailPeriksaLab() : HasMany {
        return $this->hasMany(DetailPeriksaLab::class, 'kd_jenis_prw', 'kd_jenis_prw');
    }
}
