<?php

namespace App\Models\simrs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model
{
    use HasFactory;
    protected $connection = 'simsvbaru';
    protected $table = 'kategori_barang';
    protected $primaryKey = 'kode';
    public $incrementing = false;
    protected $keyType = 'string';
}
