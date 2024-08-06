<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User_shifts extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shift_id',
        'valid_date_start',
        'valid_date_end',
        'check_in',
        'check_out',
    ];

    function shifts() : BelongsTo {
        return $this->belongsTo(Shifts::class, 'shift_id');
    }
    function users() : BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    
}
