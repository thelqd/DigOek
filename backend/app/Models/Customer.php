<?php


namespace App\Models;


class Customer extends BaseModel
{
    protected $table = 'customer';

    public function address()
    {
        return $this->hasOne('App\Model\Address');
    }
}