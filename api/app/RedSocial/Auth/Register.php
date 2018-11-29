<?php
namespace RedSocial\Auth;

use RedSocial\Models\Usuario;

class Register
{
	/**
	 * Registra usuario al si no esta creado. Retorna false si falla.
	 *
	 * @param object $usuario
	 */
	public function registrar($usuario)
	{
		// Buscamos el usuario.
		$user = new Usuario;
		if($user->getForUserName($usuario['email'])) {
            return false;
        } else {
            if($error = $user->crear($usuario)) {
				return $error;
				//return true;
			} else {
				return $error;
			}
        }
	}
}