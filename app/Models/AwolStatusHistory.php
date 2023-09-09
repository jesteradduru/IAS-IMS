<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AwolStatusHistory extends Model
{
    use HasFactory;

    protected $table = 'awol_status_history';

    protected $fillable = ['awol_process_id', 'awol_id', 'by_user_id'];

    public function awol() : BelongsTo {
        return $this->belongsTo(Awol::class, 'awol_id');
    }

    public function awol_process() : BelongsTo {
        return $this->belongsTo(AwolStatusProcess::class, 'awol_process_id');
    }
    
    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function scopeRecentHistory(Builder $query) {
        return $query->latest();
    }
}
