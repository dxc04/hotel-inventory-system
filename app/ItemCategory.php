<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Kjjdion\LaravelAdminPanel\Traits\DynamicFillable;
use Kjjdion\LaravelAdminPanel\Traits\UserTimezone;

class ItemCategory extends Eloquent
{
    use DynamicFillable, UserTimezone;

    

    public function item()
    {
        return $this->belongsTo('App\Item');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    
}