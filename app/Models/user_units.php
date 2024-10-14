<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class user_units extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'unit_id',
    ];

    function deskripsi_unit() : BelongsTo {
        return $this->belongsTo(Unit_translations::class, 'unit_id', 'id');
    }
}
