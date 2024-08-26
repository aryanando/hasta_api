<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shifts extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id'
    ];

    function userShifts() : HasMany {
        return $this->hasMany(User_shifts::class);
    }
}
