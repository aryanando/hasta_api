<?php

namespace App\Models;

use App\Models\simrs\ResepDokter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ResepObat extends Model
{
    use HasFactory;
    protected $connection = 'simsvbaru';
    protected $table = 'resep_obat';
    protected $primaryKey = 'no_resep';
    public $incrementing = false;
    protected $keyType = 'string';

    function dataResepDokter() : HasMany {
        return $this->hasMany(ResepDokter::class, 'no_resep', 'no_resep');
    }
}
