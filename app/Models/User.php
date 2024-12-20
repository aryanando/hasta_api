<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    function unit() : HasOne {
        return $this->hasOne(Unit_translations::class, 'id', 'unit_id');
    }

    function jenisKaryawan() : HasOne {
        return $this->hasOne(JenisKaryawan::class, 'id', 'jenis_karyawan_id');
    }

    function esurvey() : HasMany {
        return $this->hasMany(Esurvey::class, 'user_id', 'id');
    }

    function shifts() : HasMany {
        return $this->hasMany(User_shifts::class);
    }
}
