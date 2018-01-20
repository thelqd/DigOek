<?php

namespace App\Models;


class Hotel extends BaseModel
{
    protected $table = 'hotel';

    public function rooms()
    {
        return $this->hasMany('App\Models\Room');
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }
}