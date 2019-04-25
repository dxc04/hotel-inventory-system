<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Kjjdion\LaravelAdminPanel\Traits\DynamicFillable;
use Kjjdion\LaravelAdminPanel\Traits\UserTimezone;

class StocksComputation extends Eloquent
{
    use DynamicFillable, UserTimezone;

    

    public function room()
    {
        return $this->belongsTo('App\Room');
    }

    public function item()
    {
        return $this->belongsTo('App\ItemCategory');
    }

    
}