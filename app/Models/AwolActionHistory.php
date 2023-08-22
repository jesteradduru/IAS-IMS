<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AwolActionHistory extends Model
{
    use HasFactory;

    protected $table = 'awol_action_history';
    protected $fillable = ['description', 'awol_id'];

    public function awol() : BelongsTo {
        return $this->belongsTo(Awol::class, 'awol_id');
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

}
