<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjab extends Model
{
    use HasFactory;
    protected $connection = 'simsvbaru';
    protected $table = 'penjab';
    protected $primaryKey = 'kd_pj';
    public $incrementing = false;
    protected $keyType = 'string';
}
