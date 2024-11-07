<?php

namespace App\Models\simrs;

use App\Models\DataBarang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ResepDokter extends Model
{
    use HasFactory;
    protected $connection = 'simsvbaru';
    protected $table = 'resep_dokter';
    // protected $primaryKey = 'no_resep';
    // public $incrementing = false;
    // protected $keyType = 'string';

    function dataBarang() : HasOne {
        return $this->hasOne(DataBarang::class, 'kode_brng', 'kode_brng');
    }
}
