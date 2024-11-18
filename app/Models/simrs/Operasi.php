<?php

namespace App\Models\simrs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operasi extends Model
{
    use HasFactory;
    protected $connection = 'simsvbaru';
    protected $table = 'operasi';

    protected $primaryKey = 'no_rawat';
    public $incrementing = false;
    protected $keyType = 'string';
}
