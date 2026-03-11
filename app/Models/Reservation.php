<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

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

    public function service(): BelongsTo
    {
        return $this->BelongsTo(Service::class, 'service_id');
    }
}
