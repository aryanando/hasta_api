<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class KlaimRujukan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    function petugasPendaftaran() : HasOne {
        return $this->hasOne(User::class, 'id', 'petugas_rm');
    }
    function petugasKasir() : HasOne {
        return $this->hasOne(User::class, 'id', 'petugas_kasir');
    }
    function perujukBlu() : HasOne {
        return $this->hasOne(User::class, 'id', 'perujuk_id');
    }
}
