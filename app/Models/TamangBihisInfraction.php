<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TamangBihisInfraction extends Model
{
    use HasFactory;

    protected $fillable = ['tamang_bihis_id', 'tamang_bihis_violation_id', 'other_infraction'];

    public function tamang_bihis() : BelongsTo {
        return $this->belongsTo(TamangBihis::class);
    }
    public function violation() : BelongsTo {
        return $this->belongsTo(TamangBihisViolation::class, 'tamang_bihis_violation_id');
    }
}
