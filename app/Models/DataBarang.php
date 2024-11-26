<?php

namespace App\Models;

use App\Models\simrs\GudangBarang;
use App\Models\simrs\RiwayatBarangMedis;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DataBarang extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
    protected $connection = 'simsvbaru';
    protected $table = 'databarang';
    protected $primaryKey = 'kode_brng';
    public $incrementing = false;
    protected $keyType = 'string';

    function dataRiwayatBarangMedisLast(): HasMany
    {
        return $this->hasMany(RiwayatBarangMedis::class, "kode_brng", "kode_brng")->latest('tanggal')->limit(1);
    }

    function dataRiwayatBarangMedis(): HasMany
    {
        return $this->hasMany(RiwayatBarangMedis::class, "kode_brng", "kode_brng");
    }

    function dataGudangBarang() : HasMany {
        return $this->hasMany(GudangBarang::class, "kode_brng", "kode_brng");
    }
}
