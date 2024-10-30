<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Salary extends Model
{
    use HasFactory;
    protected $table = 'user_salary_receipt';
    protected $guarded = [];

    function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}
