<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RujukMasuk extends Model
{
    use HasFactory;
    protected $connection = 'simsvbaru';
    protected $table = 'rujuk_masuk';

    protected $primaryKey = 'no_rawat';
    public $incrementing = false;
    protected $keyType = 'string';

    function registrasi() : HasOne {
        return $this->hasOne(RegistrasiPeriksa::class,'no_rawat','no_rawat');
    }
}
