<?php

namespace RedSocial\Controllers;

use RedSocial\Auth\Auth;
use RedSocial\Core\App;
use RedSocial\Core\View;

class AuthController
{
    public function login()
    {
    	$buffer = file_get_contents('php://input');
        $data = json_decode($buffer, true);

        // TODO: Validar :D :D :D :D :D :D
        $auth = new Auth;
        if($loginData = $auth->login($data['usuario'], $data['password'])) {
            View::renderJson([
                'status' => 1,
                'data' => $loginData
            ]);
        } else {
            View::renderJson([
                'status' => 0,
                'msg' => "Usuario y/o password incorrectos."
            ]);
        }
    }
}