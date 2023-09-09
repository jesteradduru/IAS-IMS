<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AwolStatusProcess extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'final'];

    public function awol_status_history() : HasMany {
        return $this->hasMany(AwolStatusHistory::class, 'awol_process_id');
    }
}
