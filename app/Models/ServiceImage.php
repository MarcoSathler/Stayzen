<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceImage extends Model
{
    protected $table = 'services_images';

    protected $fillable = [
        'service_id',
        'image_url',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function image()
    {
        return $this->belongsTo(Service::class);
    }
}
