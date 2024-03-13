<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absens extends Model
{
    use HasFactory;

    protected $fillable = [
        'shift_id',
        'user_id',
        'check_in',
        'check_out',
    ];
}
