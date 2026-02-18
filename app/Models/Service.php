<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\UserService;
use App\Models\ServiceImage;

class Service extends Model
{
    protected $fillable = [
        'name',
        'description',
        'duration_minutes',
        'price',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function userService(): HasMany
    {
        return $this->hasMany(UserService::class);
    }

    public function serviceImage(): HasMany
    {
        return $this->hasMany(ServiceImage::class);
    }
}
