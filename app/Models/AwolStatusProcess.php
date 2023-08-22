<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AwolStatusProcess extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'final'];

    public function awol_status_history() : BelongsTo {
        return $this->belongsTo(AwolStatusHistory::class);
    }
}
