<?php

namespace App\Models\simrs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPemberianObat extends Model
{
    use HasFactory;
    protected $connection = 'simsvbaru';
    protected $table = 'detail_pemberian_obat';
    // protected $primaryKey = 'no_resep';
    public $incrementing = false;
    // protected $keyType = 'string';
}
