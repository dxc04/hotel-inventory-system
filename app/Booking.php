<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Kjjdion\LaravelAdminPanel\Traits\DynamicFillable;
use Kjjdion\LaravelAdminPanel\Traits\UserTimezone;

class Booking extends Eloquent
{
    use DynamicFillable, UserTimezone;

    

    public function room()
    {
        return $this->belongsTo('App\Room');
    }

    public function guest()
    {
        return $this->belongsTo('App\guest');
    }

    public function getCheckoutAtAttribute($value)
    {
        return $this->inUserTimezone($value);
    }
}