<?php

namespace App\Http\Controllers;


class ApiController extends Controller
{
    public function get()
    {
        // Hotel::find([1,2,3]);
        return $this->buildResponse(true, ['hallo' => 'welt']);
    }

    public function create()
    {
        // create hotel
    }

    public function delete($id)
    {
        // delete hotel
    }
}