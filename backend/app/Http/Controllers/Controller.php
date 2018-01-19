<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @param boolean $status
     * @param array $data
     */
    protected function buildResponse($status, array $data, $message = null)
    {
        $response = [
            'status' => (($status) ? 'success': 'failed'),
            'pid' => '131342414dsad2qe-24414',
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response);
    }
}
