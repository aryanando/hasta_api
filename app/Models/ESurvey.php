<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ESurvey extends Model
{
    use HasFactory;
    protected $table = 'esurvey';
    function user() : BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
