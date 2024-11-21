<?php

namespace App\Models\simrs;

use App\Models\UpdateStatusOperasi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Operasi extends Model
{
    use HasFactory;
    protected $connection = 'simsvbaru';
    protected $table = 'operasi';

    protected $primaryKey = 'no_rawat';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    function dataUpdateOperasi() : HasOne{
        return $this->hasOne(UpdateStatusOperasi::class, 'tanggal_operasi', 'tgl_operasi');
    }
}
