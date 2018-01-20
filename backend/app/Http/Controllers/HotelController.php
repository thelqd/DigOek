<?php

namespace App\Http\Controllers;


use App\Models\Hotel;
use App\Models\Rating;

class HotelController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function search()
    {
        $search = $this->request->input('search', null);

        if(isset($search)) {
            $hotels = Hotel::where('name', 'like', '%'.$search.'%')
                ->orWhere('description', 'like', '%'.$search.'%')
                ->get();
        } else {
            $hotels = Hotel::all();
        }

        $result = [];
        foreach($hotels as $hotel) {
            $result[] = $this->buildHotel($hotel);
        }

        return $this->buildResponse(true, $result);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        $hotel = Hotel::findOrFail($id);
        return $this->buildResponse(
            true,
            $this->buildHotel($hotel)
        );
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function rate($id)
    {
        $stars = $this->request->input('stars', null);
        if(isset($stars)) {
            $rating = new Rating();
            $rating->stars = (int)$stars;
            $rating->hotel_id = $id;
            $rating->entrydate = date('Y-m-d H:i:s');
            $rating->save();
            return $this->getRating($id);
        } else {
            return $this->buildResponse(
                false,
                [],
                'No Star rating given'
            );
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRating($id)
    {
        $ratings = Hotel::findOrFail($id)->ratings->avg('stars');
        return $this->buildResponse(true, ['rating' => $ratings]);

    }

    /**
     * @param Hotel $hotel
     * @return array
     */
    private function buildHotel(Hotel $hotel)
    {
        $hotelResult = [
            'id' => $hotel->id,
            'name' => $hotel->name,
            'description' => $hotel->description,
            'rating' => $hotel->ratings->avg('stars'),
            'rooms' => []
        ];
        $rooms = $hotel->rooms()
            ->select('name', 'price')
            ->groupby('name', 'price')
            ->get();
        foreach($rooms as $room) {
            $hotelResult['rooms'][] = [
                'name' => $room->name,
                'price' => $room->price
            ];
        }
        return $hotelResult;
    }
}