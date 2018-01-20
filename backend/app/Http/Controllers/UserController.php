<?php

namespace App\Http\Controllers;


use App\Auth;
use App\Models\Address;
use App\Models\Authinfo;
use App\Models\Customer;

class UserController extends Controller
{
    public function login()
    {
        $userName = $this->request->input('username', null);
        $password = $this->request->input('password', null);
        if(isset($userName) && isset($password)) {
            // login
            $customer = Customer::where('username', $userName)->first();

            $auth = new Auth($customer->password);
            if($auth->verify($password)) {
                $address = Address::find($customer->id);

                $authToken = Auth::generateToken(time());
                $authInfo = new Authinfo();
                $authInfo->apikey = $authToken;
                $authInfo->refreshapikey = false;
                $authInfo->save();

                $customer->authinfo_id = $authInfo->id;
                $customer->save();
                $result = [
                    'username' => $customer->username,
                    'firstname' => $customer->firstname,
                    'lastname' => $customer->lastname,
                    'address' => [
                        'street' => $address->street,
                        'zip_code' => $address->zipcode,
                        'city' => $address->city
                    ],
                    'usertoken' => $authToken
                ];
                return $this->buildResponse(
                    true,
                    $result,
                    'Login success'
                );
            }
            $errorMessage = 'username/password incorrect';
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
        $userToken = $this->request->input('usertoken', null);
        if(isset($userToken)) {
            $auth = Authinfo::where('apikey', $userToken)->get();
            if(count($auth->toArray()) == 1) {
                $customer = Customer::where('authinfo_id', $auth[0]->id)->first();
                $customer->authinfo_id = null;
                $customer->save();

                $auth[0]->delete();
                return $this->buildResponse(
                    true,
                    [],
                    'Logout done'
                );
            }
            $errorMessage = 'token not found';
        } else {
            $errorMessage = 'No user token given';
        }
        return $this->buildResponse(
            false,
            [],
            $errorMessage
        );
    }
}