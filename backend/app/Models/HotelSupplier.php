<?php

namespace App\Models;


class HotelSupplier extends BaseModel
{
    protected $table = 'hotel_supplier';

    public $incrementing = false;

    public $primaryKey = ['hotel_id', 'supplier_id'];
}