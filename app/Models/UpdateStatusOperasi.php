<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UpdateStatusOperasi extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $guarded = ['id'];

    function dataPetugas(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }
}
