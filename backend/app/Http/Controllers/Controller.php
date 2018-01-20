<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @var string
     */
    private $pid;

    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->pid =$this->request->input('pid', 0);
    }

    /**
     * @param boolean $status
     * @param array $data
     */
    protected function buildResponse($status, array $data, $message = null)
    {
        $response = [
            'status' => (($status) ? 'success': 'failed'),
            'pid' => $this->pid,
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response);
    }
}
