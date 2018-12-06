<?php
namespace RedSocial\Auth;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use RedSocial\Models\Usuario;

class Auth
{
	// En php 7.1+, las constantes pueden ser privadas, lo que sería más que recomendable
	// para éstas dos. No las pongo así por si tienen un php desatualizado en sus máquinas.
	const TOKEN_ISSUER = 'JulietaLucio';
	const SIGNER_KEY = 'ASJHjnfkjasdfhnkasjdkasDHSDAS';

	/**
	 * Loguea al usuario. Retorna false si falla.
	 *
	 * @param string $usuario
	 * @param string $password
	 * @return array|bool
	 */
	public function login($usuario, $password)
	{
		// Buscamos el usuario.
		$user = new Usuario;
		if($res = $user->getForUserName($usuario)) {
			if($password == $user->getPass()) {
				$token = $this->generateToken($user);
				return [
					'token' => (string) $token,	
					'user' => [
						'id' => $user->getID(),
						'usuario' => $user->getEmail(),
					]
				];
			} else {
				return [ $res ];
			}
		} else {
			return "false2";
		}
	}

	/**
	 * Genera un token de autenticación.
	 *
	 * @param Usuario $user
	 * @return \Lcobucci\JWT\Token
	 */
	public function generateToken($user)
	{
		$builder = new Builder();

		$builder->setIssuer(self::TOKEN_ISSUER);
		$builder->set('id', $user->getID());

		$signer = new Sha256();

		$builder->sign($signer, self::SIGNER_KEY);
		$token = $builder->getToken();
		return $token;
	}

	/**
	 * Retorna un array con los datos del token si es válido.
	 * false de lo contrario.
	 *
	 * @param string $token
	 * @return array|boolean
	 */
	public static function isTokenValid($token)
	{
		if($token == "null" || empty($token)) {
			return false;
		}

		$parser = new Parser;
		$token = $parser->parse((string) $token);

		$valData = new ValidationData;
		$valData->setIssuer(self::TOKEN_ISSUER);

		if(!$token->validate($valData)) {
			return false;
		}
		$signer = new Sha256;

		if(!$token->verify($signer, self::SIGNER_KEY)) {
			return false;
		}

		return [
			'id' => $token->getClaim('id')
		];
	}

	/********** Estos métodos no los usamos para la API **********/
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