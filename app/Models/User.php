<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

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
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function proactive() : HasMany {
        return $this->hasMany(ProActive::class, 'by_user_id');
    }
    public function absent_personnel() : HasMany {
        return $this->hasMany(AbsentPersonnel::class, 'by_user_id');
    }
    public function tamang_bihis() : HasMany {
        return $this->hasMany(TamangBihis::class, 'by_user_id');
    }
    public function unit_infractions() : HasMany {
        return $this->hasMany(UnitInfraction::class, 'by_user_id');
    }
    public function covid_infraction() : HasMany {
        return $this->hasMany(CovidInfraction::class, 'by_user_id');
    }
    public function awol() : HasMany {
        return $this->hasMany(Awol::class, 'by_user_id');
    }
    public function awol_action_history() : HasMany {
        return $this->hasMany(AwolActionHistory::class, 'by_user_id');
    }
    public function awol_status_history() : HasMany {
        return $this->hasMany(AwolStatusHistory::class, 'by_user_id');
    }
}
