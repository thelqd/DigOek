<?php

namespace App\Http\Controllers;


use App\Auth;
use App\Models\Address;
use App\Models\Hotel;
use App\Models\HotelSupplier;
use App\Models\Room;

class ApiController extends Controller
{
    public function get()
    {
        // Hotel::find([1,2,3]);
        return $this->buildResponse(true, ['hallo' => 'welt']);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @author Daniel Schubert
     */
    public function create()
    {
        $data = $this->request->input('data', null);
        if(isset($data) && isset($data['supplierId'])) {
            if (Auth::checkSupplierKey(
                (int)$data['supplierId'],
                $this->request->input('auth')
            )) {
                // check hotel data
                if(isset($data['hotel']['name'])
                    && isset($data['hotel']['description'])
                    && is_array($data['hotel']['address'])) {
                    // insert address
                    $addressArray = $data['hotel']['address'];
                    $address = new Address();
                    $address->street = ((isset($addressArray['street'])) ? $addressArray['street'] : 'none');
                    $address->zipcode = ((isset($addressArray['zipcode'])) ? $addressArray['zipcode'] : '0000');
                    $address->city = ((isset($addressArray['city'])) ? $addressArray['city'] : 'none');
                    $address->save();

                    $hotel = new Hotel();
                    $hotel->address_id = $address->id;
                    $hotel->hotelchain_id = null;
                    $hotel->name = $data['hotel']['name'];
                    $hotel->description = $data['hotel']['description'];
                    $hotel->save();

                    $hotelSupplier = new HotelSupplier();
                    $hotelSupplier->hotel_id = $hotel->id;
                    $hotelSupplier->supplier_id = (int)$data['supplierId'];
                    $hotelSupplier->timestamp = date('Y-m-d H:i:s');
                    $hotelSupplier->save();

                    //optional add rooms
                    if(isset($data['hotel']['rooms']) && is_array($data['hotel']['rooms'])) {
                        foreach($data['hotel']['rooms'] as $room) {
                            $this->addRoom($hotel->id, $room);
                        }
                    }


                    return $this->buildResponse(
                        true,
                        ['hotelId' => $hotel->id],
                        'Hotel Created');
                } else {
                    $errorMessage = 'Hotel data incomplete';
                }
            } else {
                $errorMessage = 'Api key not valid for supplier';
            }
        } else {
            $errorMessage = 'No supplier id provided';
        }
        return $this->buildResponse(false, [], $errorMessage);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @author Martin Kunz
     */
    public function update($id)
    {
        $data = $this->request->input('data', null);
        $auth = $this->request->input('auth', null);
        
        
        if(!isset($data))
            return $this->buildResponse(false, [], "data missing");
        if(!isset($auth))
            return $this->buildResponse(false, [], "fake auth missing");   
        $supplierID = (int)$data['supplierId'];
        if (!Auth::checkSupplierKey(
            $supplierID,
            $auth)) return $this->buildResponse(false, [], "fake auth failed");
        $hotelData = $data['hotel'];
        if(!isset($hotelData['name']))
            return $this->buildResponse(false, [], "no hotel name");
        $addressData = $hotelData['address'];
        
        $hotel = Hotel::find($id);
        $hotel->hotelchain_id = null;
        $hotel->name = $hotelData['name'];
        $hotel->description = $hotelData['description'];
        $hotel->update();

        $deletedRooms = Room::where('hotel_id', $id)->delete();

        $rooms = $hotelData['rooms'];
        foreach($rooms as $room) {
            $this->addRoom($hotel->id, $room);
        }

        $address = Address::find($hotel->address_id);
        $address->street = $addressData['street'];
        $address->zipcode = $addressData['zipcode'];
        $address->city = $addressData['city'];
        $address->update();
        return $this->buildResponse(true, [], 'Hotel Updated');
    }


    /**
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse
     * @author Daniel Schubert
     */
    public function delete($id)
    {
        $data = $this->request->input('data', null);
        if(isset($data) && isset($data['supplierId'])) {
            $supplierId = (int)$data['supplierId'];
            if (Auth::checkSupplierKey($supplierId, $this->request->input('auth'))) {
                $hotel = Hotel::findOrFail($id);
                $count = HotelSupplier::where('hotel_id', $hotel->id)
                    ->andWhere('supplier_id', $supplierId)
                    ->count();
                if($count == 1) {
                    // Hotel belongs to supplier, delete rooms, relation and hotel itself
                    $hotel->rooms->delete();
                    $hotel->ratings->delete();
                    HotelSupplier::where('hotel_id', $hotel->id)
                        ->andWhere('supplier_id', $supplierId)
                        ->delete();
                    $hotel->delete();
                    return $this->buildResponse(true, [], 'Hotel deleted');
                } else {
                    $errorMessage = 'Hotel not available for supplier';
                }
            } else {
                $errorMessage = 'Api key not valid for supplier';
            }
        } else {
            $errorMessage = 'No supplier id provided';
        }
        return $this->buildResponse(true, [], $errorMessage);
    }

    /**
     * @param integer $hotelId
     * @param array $room
     */
    private function addRoom($hotelId, array $room)
    {
        if(array_key_exists('name', $room)
            && array_key_exists('price', $room)
            && array_key_exists('beds', $room)) {
            $newRoom = new Room();
            $newRoom->name = $room['name'];
            $newRoom->price = $room['price'];
            $newRoom->beds = $room['beds'];
            $newRoom->hotel_id = $hotelId;
            $newRoom->save();
        }
    }

 

}