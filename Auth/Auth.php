<?php
namespace DaVinci\Auth;

use TP2\Models\Usuario;

class Auth
{
	/**
	 * Loguea al usuario. Retorna false si falla.
	 *
	 * @param string $usuario
	 * @param string $password
	 * @return bool
	 */
	public function login($usuario, $password)
	{
		$user = new Usuario;
		/*if($user->traerPorUsuario($usuario)) {
			if(password_verify($password, $user->password)) {
				$this->loguearUsuario($user);
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}*/
	}

	/** 
 	 * Marca como logueado al usuario en el sistema.
 	 *
 	 * @param Usuario $user
 	 */
	public function loguearUsuario(Usuario $user)
	{
		$_SESSION['id_user'] = $user->id;
		$_SESSION['usuario'] = $user->usuario;
	}

	/**
	 * Desloguea al usuario el sistema.
	 */
	public function logout()
	{
		unset($_SESSION['id_user']);
		unset($_SESSION['usuario']);
	}

	/**
	 * Retorna true si el usuario está logueado. False de lo 
	 * contrario.
	 *
	 * @return bool
	 */
	public static function isLogged()
	{
		if(isset($_SESSION['id_user'])) {
			return true;
		} else {
			return false;
		}
	}
}