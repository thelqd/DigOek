<?php

namespace App\Http\Controllers;

use App\Models\Authinfo;
use App\Models\Supplier;
use App\Models\HotelSupplier;
use App\Models\Hotel;


class ApiController extends Controller
{
    public function get()
    {
		$token = $this->request->input('auth', null);
		$hotels = array();
		
		if(isset($token)) {
            $apikey = Authinfo::where('apikey', $token)->first();
			$supplier = Supplier::where('authinfo_id', $apikey->id)->first();
			if(!empty($supplier)) {
				$hotelids = HotelSupplier::where('supplier_id', $supplier->id)->get();
				foreach($hotelids as $currenthotel){
					$hotels[] = $currenthotel->hotel_id;
				}
				if(!empty($hotels)) {
					$hotelarray = Hotel::find($hotels);
					$result = array();
					foreach($hotelarray as $hotel){
						$result[] = $this->buildHotel($hotel);
					}
					return $this->buildResponse(true, $result);
				} else {
					$errormessage = 'You dont own any hotels';
				}
			} else {
				$errormessage = 'this function is not available';
			}		
        } else {
			$errormessage = 'not logged in';
		}

		return $this->buildResponse(false, [], $errormessage); 
    }
	
	private function buildHotel(Hotel $hotel)
    {
        $hotelResult = [
            'id' => $hotel->id,
            'name' => $hotel->name,
            'roomCount' => $hotel->rooms->count(),
        ];
        return $hotelResult;
    }
}