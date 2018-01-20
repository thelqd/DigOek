<?php


namespace App\Models;


class Customer extends BaseModel
{
    protected $table = 'customer';

    public function address()
    {
        return $this->hasOne('App\Model\Address');
    }

    public function authinfo()
    {
        return $this->hasOne('App\Models\Authinfo');
    }
}