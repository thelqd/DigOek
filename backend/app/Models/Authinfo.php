<?php


namespace App\Models;


class Authinfo extends BaseModel
{
    protected $table = 'authinfo';

    public function customer()
    {
        return $this->hasOne('App\Models\Customer');
    }
}