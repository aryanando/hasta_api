<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenTokens extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'used_for',
        'user_id',
        'created_by',
    ];
}
