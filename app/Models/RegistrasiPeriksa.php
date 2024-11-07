<?php

namespace App\Models;

use App\Models\simrs\DetailPemberianObat;
use App\Models\simrs\PeriksaLab;
use App\Models\simrs\PeriksaRadiologi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    function dataPoli() : HasOne {
        return $this->hasOne(Poliklinik::class, 'kd_poli', 'kd_poli');
    }

    function dataDokter() : HasOne {
        return $this->hasOne(Dokter::class, 'kd_dokter', 'kd_dokter');
    }

    function dataPenjab() : HasOne {
        return $this->hasOne(Penjab::class, 'kd_pj', 'kd_pj');
    }

    function dataResepObat() : HasMany {
        return $this->hasMany(ResepObat::class, 'no_rawat', 'no_rawat');
    }

    function dataPeriksaRadiologi() : HasMany {
        return $this->hasMany(PeriksaRadiologi::class, 'no_rawat', 'no_rawat');
    }

    function dataPeriksaLaboratorium() : HasMany {
        return $this->hasMany(PeriksaLab::class, 'no_rawat', 'no_rawat')->with('dataJenisPerawatanLab');
    }

    function dataPemberianObat() : HasMany {
        return $this->hasMany(DetailPemberianObat::class, 'no_rawat', 'no_rawat');
    }

}
