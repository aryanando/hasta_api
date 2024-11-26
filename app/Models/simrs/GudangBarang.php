<?php

namespace App\Models\simrs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GudangBarang extends Model
{
    use HasFactory;
    protected $connection = 'simsvbaru';
    protected $table = 'gudangbarang';
    // protected $primaryKey = 'kode_brng';
    // public $incrementing = false;
    // protected $keyType = 'string';
}
