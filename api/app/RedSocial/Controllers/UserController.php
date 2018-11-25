<?php
namespace RedSocial\Controllers;

use RedSocial\Auth\Auth;
use RedSocial\Core\View;
use RedSocial\Models\Usuario;

class UsuarioController extends BaseController
{
	public function perfil()
	{
		$userId = $this->checkUserIsLogged();

		$user = new Usuario;
		$user->traerPorId($userId);

		View::renderJson([
			'status' => 1,
			'data' => [
				'id' 		=> $user->id,
				'usuario' 	=> $user->usuario,
				'email' 	=> $user->email,
			]
		]);
	}
}