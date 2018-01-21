<?php

namespace App\Http\Controllers;


use App\Auth;
use App\Models\Hotel;

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
        $supplierId = $this->request->input('supplierId', 0);
        if(Auth::checkSupplierKey($supplierId, $this->request->input('auth'))) {
            $hotel = new Hotel();
        } else {
            $errorMessage = 'Api key not valid for supplier';
        }
        return $this->buildResponse(false, [], $errorMessage);
    }

    /**
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse
     * @author Daniel Schubert
     */
    public function delete($id)
    {
        // delete hotel
        return $this->buildResponse(true, [], 'Hotel deleted');
    }
}