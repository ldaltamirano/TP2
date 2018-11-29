<?php

namespace RedSocial\Controllers;

use RedSocial\Auth\Register;
use RedSocial\Core\App;
use RedSocial\Core\View;

class RegisterController
{
    public function registrar()
    {
    	$buffer = file_get_contents('php://input');
        $data = json_decode($buffer, true);
        $register = new Register;
        if($registerData = $register->registrar($data)) {
            View::renderJson([
                'status' => 1,
                'rd' => $registerData,
            ]);
        } else {
            View::renderJson([
                'status' => 0,
                'rd' => $registerData,
            ]);
        }
    }
}