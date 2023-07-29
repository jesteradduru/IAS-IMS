<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TamangBihisViolation extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function tamang_bihis() : HasMany {
        return $this->hasMany(TamangBihis::class, 'tamang_bihis_violation_id');
    }

    public function infraction() : HasMany {
        return $this->hasMany(TamangBihisInfraction::class);
    }
}
