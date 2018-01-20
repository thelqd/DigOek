<?php

namespace App\Http\Controllers;


use App\Models\Customer;

class UserController extends Controller
{
    public function login()
    {
        $userName = $this->request->input('username', null);
        $password = $this->request->input('password', null);
        if(isset($userName) && isset($password)) {
            // login
            $customer = Customer::with('address')
                ->where('username', $userName)
                ->get();

            dd($customer);

            return;
        } else {
            $errorMessage = 'username/password missing';
        }
        return $this->buildResponse(
            false,
            [],
            $errorMessage
        );
    }

    public function logout()
    {
        // do logout
    }
}