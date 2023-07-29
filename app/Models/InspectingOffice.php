<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InspectingOffice extends Model
{
    use HasFactory;

    public function proactive() : HasMany {
        return $this->hasMany(ProActive::class, 'inspecting_office_id');
    }
}
