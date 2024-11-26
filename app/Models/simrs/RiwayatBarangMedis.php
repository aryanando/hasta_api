<?php

namespace App\Models\simrs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatBarangMedis extends Model
{
    use HasFactory;
    protected $connection = 'simsvbaru';
    protected $table = 'riwayat_barang_medis';
    public $timestamps = false;
    // protected $primaryKey = 'kode_brng';
    // public $incrementing = false;
    // protected $keyType = 'string';
}
