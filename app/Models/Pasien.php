<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pasien extends Model
{
    use HasFactory;
    protected $connection = 'simsvbaru';
    protected $table = 'pasien';
    protected $primaryKey = 'no_rkm_medis';
    public $incrementing = false;
    protected $keyType = 'string';

    function regPeriksa() : HasMany {
        return $this->hasMany(RegistrasiPeriksa::class, 'no_rkm_medis', 'no_rkm_medis');
    }
}
