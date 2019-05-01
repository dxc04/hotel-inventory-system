<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Kjjdion\LaravelAdminPanel\Traits\DynamicFillable;
use Kjjdion\LaravelAdminPanel\Traits\UserTimezone;

class ItemStock extends Eloquent
{
    use DynamicFillable, UserTimezone;

    

    public function item()
    {
        return $this->belongsTo('App\Item');
    }

    
}