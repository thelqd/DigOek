<?php

namespace App;


use App\Models\Authinfo;
use App\Models\Supplier;

class Auth
{
    const SALT = 'e45fd2';
    /**
     * @var string
     */
    private $hash;

    public function __construct($hash)
    {
        $this->hash = $hash;
    }

    /**
     * @param string $password
     * @return bool
     */
    public function verify($password)
    {
        return password_verify($password, $this->hash);
    }

    /**
     * @param $string
     * @return string
     */
    public static function hashPassword($string)
    {
        return password_hash($string, PASSWORD_BCRYPT);
    }

    /**
     * @param string $string
     * @return string
     */
    public static function generateToken($string)
    {
        return sha1($string.self::SALT);
    }

    /**
     * @param integer $supplierId
     * @param string $key
     * @return boolean
     */
    public static function checkSupplierKey($supplierId, $key)
    {
        $authinfo = Authinfo::where('apikey', $key)->get();
        if(count($authinfo->toArray()) == 1) {
            $supplier = Supplier::where('authinfo_id', $authinfo[0]->id)->first();
            return $supplier->id == $supplierId;
        } else {
            return false;
        }
    }
}