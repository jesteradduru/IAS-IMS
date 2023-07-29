<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProActive extends Model
{
    use HasFactory;

    protected $fillable = ['inspecting_office_id', 'date_time', 'unit_id', 'street', 'barangay', 'municipality', 'province', 'region',  'ap', 'aa', 'ua', 'type', 'special_category'];

    public function encoder() : BelongsTo {
        return $this->belongsTo(User::class, 'id');
    }

    public function unit() : BelongsTo {
        return $this->belongsTo(Unit::class);
    }

    public function inspecting_office() : BelongsTo {
        return $this->belongsTo(InspectingOffice::class);
    }

    public function scopeFilter(Builder $query, array $filters) : Builder
    {
        return $query->when(
            $filters['type'] ?? false,
            fn ($query, $value) => $query->where('type', '=', $value)
        )->when(
            $filters['special_category'] ?? false,
            fn($query, $value) => $query->where('special_category', '=', $value)
        );
    }
}
