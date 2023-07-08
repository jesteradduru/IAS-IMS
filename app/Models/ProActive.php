<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProActive extends Model
{
    use HasFactory;

    protected $fillable = ['inspecting_office_id', 'nr', 'date_time', 'unit_id', 'address', 'ts', 'ap', 'aa', 'dispatch'];

    public function encoder() : BelongsTo {
        return $this->belongsTo(User::class, 'by_user_id');
    }

    public function unit() : HasOne {
        return $this->hasOne(Unit::class, 'unit_id');
    }

    public function inspecting_office() : HasOne {
        return $this->hasOne(InspectingOffice::class, 'inspecting_office_id');
    }
}
