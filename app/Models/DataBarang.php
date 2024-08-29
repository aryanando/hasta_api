<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DataBarang extends Model
{
    use HasFactory;
    protected $connection = 'simsvbaru';
    protected $table = 'databarang';
    protected $primaryKey = 'kode_brng';
    public $incrementing = false;
    protected $keyType = 'string';

    function dataRiwayatMedis() : HasMany {
        return $this->hasMany(RiwayatBarangMedis::class, "kode_brng", "kode_brng");
    }
}
