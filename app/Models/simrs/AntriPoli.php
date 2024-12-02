<?php

namespace App\Models\simrs;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\RegistrasiPeriksa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AntriPoli extends Model
{
    use HasFactory;
    protected $connection = 'simsvbaru';
    protected $table = 'antripoli';
    public $timestamps = false;

    public function dataDokter() : HasOne {
        return $this->hasOne(Dokter::class, 'kd_dokter', 'kd_dokter');
    }

    public function dataRegPriksa() : HasOne {
        return $this->hasOne(RegistrasiPeriksa::class, 'no_rawat', 'no_rawat');
    }
}
