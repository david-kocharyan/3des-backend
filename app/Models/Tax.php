<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', "id");
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', "id");
    }

}
