<?php

namespace App\Http\Controllers;


use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $search = $request->input('search', null);

        if(isset($search)) {
            $hotels = Hotel::where('name', 'like', '%'.$search.'%')->get();
        } else {
            $hotels = Hotel::all();
        }

        return $this->buildResponse(true, $hotels->toArray());
    }

    public function get(Request $request)
    {
        $id = $request->input('id', null);
        $hotel = Hotel::where('id', $id);

        return $this->buildResponse(true, $hotel);

    }

}