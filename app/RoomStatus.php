<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Kjjdion\LaravelAdminPanel\Traits\DynamicFillable;
use Kjjdion\LaravelAdminPanel\Traits\UserTimezone;

class RoomStatus extends Eloquent
{
    use DynamicFillable, UserTimezone;

    protected $casts = ['status' => 'array'];

    public function room()
    {
        return $this->belongsTo('App\Room');
    }

    
}