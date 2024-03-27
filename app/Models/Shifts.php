<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shifts extends Model
{
    use HasFactory;

    protected $fillable = [
        'shift_name',
        'check_in',
        'check_out',
        'next_day',
        'color',
        'unit_id',
    ];
}
