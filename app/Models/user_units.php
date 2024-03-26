<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_units extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'unit_id',
    ];
}
