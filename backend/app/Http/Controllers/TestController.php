<?php

namespace App\Http\Controllers;


use App\Models\Address;
use App\Models\Authinfo;
use App\Models\Customer;
use App\Models\Hotel;
use App\Models\Rating;
use App\Models\Room;
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
            'Doppelzimmer' => [50, 69, 1],
            'Einzelzimmer' => [70, 99, 2],
            'Premium Suite' => [100, 150, 4]
        ];
        $hotels = [4,5,6,7,8];

        /*foreach($hotels as $hotel) {
            foreach($names as $name => $data) {
                $roomCount = rand(5, 15);
                $price = rand($data[0], $data[1]);
                for($i = 0; $i < $roomCount; $i++) {
                    $room = new Room();
                    $room->name = $name;
                    $room->price = $price;
                    $room->beds = $data[2];
                    $room->hotel_id = $hotel;
                    $room->save();
                }
            }
        }
        /*foreach($names as $name) {
            $hotel = new Hotel();
            $hotel->name = $name;
            $hotel->address_id = 1;
            //$hotel->hotelchain_id = 0;
            $hotel->description = 'Lorem ipsum...';
            $hotel->save();
        }*/
        /*foreach($hotels as $hotel) {
            for ($i = 0; $i < 10; $i++) {
                $rating = new Rating();
                $rating->stars = rand(1,5);
                $rating->hotel_id = $hotel;
                $rating->entrydate = date('Y-m-d H:i:s');
                $rating->save();
            }
        }*/

        /*$users = [];
        $users[] = [
            'names' => [
                'Max',
                'Mustermann',
                'maxm'
            ],
            'pass' => password_hash('maxm', PASSWORD_BCRYPT)
        ];

        $users[] = [
            'names' => [
                'Peter',
                'Tester',
                'pete'
            ],
            'pass' => password_hash('pete', PASSWORD_BCRYPT)
        ];

        $users[] = [
            'names' => [
                'Daniel',
                'Schubert',
                'dansch'
            ],
            'pass' => password_hash('dansch', PASSWORD_BCRYPT)
        ];

        $users[] = [
            'names' => [
                'Martin',
                'Kunz',
                'maku'
            ],
            'pass' => password_hash('maku', PASSWORD_BCRYPT)
        ];

        foreach($users as $user) {
            $address = new Address();
            $address->street = 'Teststr '.rand(1, 45);
            $address->zipcode = '1010';
            $address->city = 'Vienna';
            $address->save();

            $customer = new Customer();
            $customer->firstname = $user['names'][0];
            $customer->lastname  = $user['names'][1];
            $customer->username = $user['names'][2];
            $customer->password = $user['pass'];
            $customer->address_id = $address->id;
            $customer->save();
        }*/

        //dd($authinfo, $supplier);
        return response()->json(true);
    }
}