<?php

namespace App\Http\Controllers;


use App\Models\Authinfo;
use App\Models\Customer;
use App\Models\Hotel;
use App\Models\Order;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * @var Customer
     */
    private $customer = null;

    /**
     * BookingController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->setCustomer();
    }

    /**
     * @param int $hotelId
     * @param string $roomName
     * @return \Illuminate\Http\JsonResponse
     */
    public function book($hotelId, $roomName)
    {
        if($this->customer instanceof Customer) {
            $hotel = Hotel::findOrFail($hotelId);
            $room = $hotel->rooms->where('name', urldecode($roomName));
            $roomArray = $room->toArray();
            if(count($roomArray) > 0) {
                $firstRoom = current($roomArray);
                $order = new Order();
                $order->customer_id = $this->customer->id;
                $order->hotel_id = $hotel->id;
                $order->amount = $firstRoom['price'];
                $order->save();

                return $this->buildResponse(
                    true,
                    [
                        'order' => 'done'
                    ]
                );
            }
            $errorMessage = 'unknown room';
        } else {
            $errorMessage = 'Customer not found';
        }
        return $this->buildResponse(
            false,
            [],
            $errorMessage
        );
    }

    private function setCustomer()
    {
        $userToken = $this->request->input('usertoken', null);
        if(isset($userToken)) {
            $auth = Authinfo::where('apikey', $userToken)->get();
            if(count($auth->toArray()) == 1) {
                // get customer
                $this->customer =$auth[0]->customer;
            } else {
                $this->customer = null;
            }
        }
    }
}