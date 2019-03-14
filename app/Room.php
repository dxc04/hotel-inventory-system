<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Kjjdion\LaravelAdminPanel\Traits\DynamicFillable;
use Kjjdion\LaravelAdminPanel\Traits\UserTimezone;

class Room extends Eloquent
{
    use DynamicFillable, UserTimezone;

    

    public function room_type()
    {
        return $this->belongsTo('App\RoomType');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    
}
