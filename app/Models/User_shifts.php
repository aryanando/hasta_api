<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_shifts extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shift_id',
        'valid_date_start',
        'valid_date_end'
    ];
}
