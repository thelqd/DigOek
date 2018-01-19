<?php

namespace App\Http\Controllers;


use App\Models\Address;
use App\Models\Authinfo;
use App\Models\Hotel;
use App\Models\Supplier;

class TestController extends Controller
{
    public function test()
    {
        /*$address =  new Address();
        $address->street = 'test 122';
        $address->zipcode = '1200';
        $address->city = 'Vienna';
        $address->save();

        dd($address);

        $authinfo = new Authinfo();
        $authinfo->username = 'fronteduser';
        $authinfo->password = '12345';
        $authinfo->apikey = '9ecc8459ea5f39f9da55cb4d71a70b5d1e0f0b80';
        $authinfo->refreshapikey = false;
        $authinfo->pwhash = sha1('12345');

        $authinfo->save();

        $supplier = new Supplier();
        $supplier->name = 'hotelbooking.org';
        $supplier->companytype = 'AG';
        $supplier->contactname = 'Daniel Schubert';

        $supplier->save();*/

        $names = [
            'Hilton',
            'Mariott',
            'Trump',
            'Ibes',
            'Hyatt'
        ];
        /*foreach($names as $name) {
            $hotel = new Hotel();
            $hotel->name = $name;
            $hotel->address_id = 1;
            //$hotel->hotelchain_id = 0;
            $hotel->description = 'Lorem ipsum...';
            $hotel->save();
        }*/

        //dd($authinfo, $supplier);
        return response()->json(true);
    }
}