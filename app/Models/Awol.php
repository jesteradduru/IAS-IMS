<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Awol extends Model
{
    use HasFactory;

    protected $table = 'awol';

    protected $fillable = ['inspecting_office_id', 'by_user_id', 'unit_id',  'date', 'effectivity_date',  'order_number', 'status', 'fullname', 'remarks'];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class, 'id');
    }

    public function unit() : BelongsTo {
        return $this->belongsTo(Unit::class);
    }

    public function inspecting_office() : BelongsTo {
        return $this->belongsTo(InspectingOffice::class);   
    }

    public function awol_action_history() : HasMany {
        return $this->hasMany(AwolActionHistory::class, 'awol_id');   
    }
    public function awol_status_history() : HasMany {
        return $this->hasMany(AwolStatusHistory::class, 'awol_id');   
    }


}
