<?php
namespace RedSocial\Controllers;

use RedSocial\Auth\Auth;
use RedSocial\Core\View;
use RedSocial\Models\Usuario;

class UserController extends BaseController
{
	public function obtenerUsuario()
	{
		$userId = $this->checkUserIsLogged();
		$user = new Usuario;
		$res = $user->getForId($userId);
		// var_dump($user);
		// var_dump($userId);
		// var_dump($res);
		View::renderJson([
			'status' => 1,
			'data' => [
				'id' 		=> $user->getID(),
				'nombre' 		=> $user->getNombre(),
				'apellido' 		=> $user->getApellido(),
				'email' 		=> $user->getEmail(),
				'dni' 		=> $user->getDni(),
				'pass' 		=> $user->getPass()				
			],
			'userId' => $userId
		]);
	}
}