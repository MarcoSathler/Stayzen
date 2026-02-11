<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimeSlot extends Model
{
    protected $fillable = [
        'resource_id',
        'day_of_week',   // 0-6
        'start_time',    // HH:MM:SS
        'end_time',      // HH:MM:SS
    ];

    public function resource(): BelongsTo
    {
        return $this->belongsTo(Resource::class);
    }
}
