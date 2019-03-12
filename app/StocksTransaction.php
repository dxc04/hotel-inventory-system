<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Kjjdion\LaravelAdminPanel\Traits\DynamicFillable;
use Kjjdion\LaravelAdminPanel\Traits\UserTimezone;

class StocksTransaction extends Eloquent
{
    use DynamicFillable, UserTimezone;

    

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

    public function purchase()
    {
        return $this->belongsTo('App\Purchase');
    }

    
}