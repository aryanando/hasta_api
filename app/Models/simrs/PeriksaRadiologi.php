<?php

namespace App\Models\simrs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriksaRadiologi extends Model
{
    use HasFactory;
    protected $connection = 'simsvbaru';
    protected $table = 'periksa_radiologi';
    // protected $primaryKey = 'no_resep';
    public $incrementing = false;
    // protected $keyType = 'string';

}
