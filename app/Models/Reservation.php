<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'service_id',
        'status', // pending, confirmed, cancelled
        'check_in',
        'check_out',
        'cancelled_at',
        'notes',
    ];

    protected $casts = [
        'check_in'     => 'datetime',
        'check_out'       => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function service(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}
