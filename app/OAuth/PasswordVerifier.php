<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 27/12/15
 * Time: 10:41
 */

namespace ProjManag\OAuth;

use Illuminate\Support\Facades\Auth;

class PasswordVerifier
{

    public function verify($username, $password)
    {
        $credentials = [
            'email'    => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }

}