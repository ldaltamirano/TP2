<?php
namespace RedSocial\Controllers;

use RedSocial\Auth\Auth;
use RedSocial\Core\View;

class BaseController
{
	public function checkUserIsLogged()
	{
		$token = $_SERVER['HTTP_X_TOKEN'];

		if(!$tokenData = Auth::isTokenValid($token)) {
			View::renderJson([
				'status' => -1,
				'msg' => 'Se requiere estar autenticado para realizar esta acción.'
			]); // blah blah
			exit;
		} // EZ

		return $tokenData['id'];
	}
}