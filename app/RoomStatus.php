<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Kjjdion\LaravelAdminPanel\Traits\DynamicFillable;
use Kjjdion\LaravelAdminPanel\Traits\UserTimezone;

class RoomStatus extends Eloquent
{
    use DynamicFillable, UserTimezone;

    

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function status()
    {
        return $this->belongsTo('App\Room');
    }

    
}