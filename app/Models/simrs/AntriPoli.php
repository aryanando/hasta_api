<?php

namespace App\Models\simrs;

use App\Models\Dokter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AntriPoli extends Model
{
    use HasFactory;
    protected $connection = 'simsvbaru';
    protected $table = 'antripoli';
    public $timestamps = false;

    public function dataDokter() : HasOne {
        return $this->hasOne(Dokter::class, 'kd_dokter', 'kd_dokter');
    }
}
