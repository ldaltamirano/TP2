<?php
namespace RedSocial\Models;

use Exception;
use RedSocial\DB\DBConnection;
use RedSocial\Models\Perfil;

class Usuario {
    protected $id;
    protected $nombre;
    protected $apellido;
    protected $dni;
    protected $email;
    protected $pass;
    protected $perfil;

    public function crear($usuario) {
        $this->nombre = $usuario['nombre'];
        $this->apellido = $usuario['apellido'];
        $this->dni = $usuario['dni'];
        $this->email = $usuario['email'];
        $this->pass = $usuario['password'];
        $this->perfil = $usuario['perfil'];

        $db = DBConnection::getConnection();
		$query = "INSERT INTO usuario (NOMBRE, APELLIDO, DNI, EMAIL, CLAVE, PERFIL) VALUES ('$this->nombre','$this->apellido', $this->dni, '$this->email', '$this->pass', $this->perfil)";
		$stmt = $db->prepare($query);
        $stmt->execute();

        return $query;
    }

    public function getForId($idUsuario) {
        $db = DBConnection::getConnection();
		$query = "SELECT ID_USUARIO, NOMBRE, APELLIDO, EMAIL, DNI, CLAVE, PERFIL FROM usuario
				WHERE ID_USUARIO = ?";
		$stmt = $db->prepare($query);
		$stmt->execute([$idUsuario]);
		if($fila = $stmt->fetch()) {
			$this->cargarDatosDeArray($fila);
			return $idUsuario;
		} else {
			return $idUsuario;
		}
    }

    public function getForUserName($userName) {
        $db = DBConnection::getConnection();
		$query = "SELECT ID_USUARIO, NOMBRE, APELLIDO, EMAIL,DNI, CLAVE, PERFIL FROM usuario
				WHERE EMAIL = ?";
		$stmt = $db->prepare($query);
		$stmt->execute([$userName]);
		if($fila = $stmt->fetch()) {
			$this->cargarDatosDeArray($fila);
			return true;
		} else {
			return false;
		}
    }
    
    	/**
	 * Carga los datos de la $fila en el objeto.
	 *
	 * @param array $fila
	 */
	public function cargarDatosDeArray($fila)
	{
		$this->id       	= $fila['ID_USUARIO'];
		$this->nombre  	    = $fila['NOMBRE'];
		$this->apellido  	= $fila['APELLIDO'];
		$this->dni  	    = $fila['DNI'];
		$this->email  	    = $fila['EMAIL'];
        $this->pass 		= $fila['CLAVE'];
        //$this->perfil       = new Perfil($fila['PERFIL']);
    }
    
 /**
	 * Devuelve el dato $ del objeto usuario
	 */
	 public function getID() {
        return $this->id;
    }

/**
    * Devuelve el dato $userName del objeto usuario
    */
   public function getEmail() {
       return $this->email;
   }

/**
    * Devuelve el dato $pass del objeto usuario
    */
   public function getPass() {
       return $this->pass;
   }

/**
    * Devuelve el dato $nombre del objeto usuario
    */
    public function getNombre() {
        return $this->nombre;
    }
/**
    * Devuelve el dato $perfil del objeto usuario
    */
    public function getPerfil() {
        return $this->perfil;
    }

 /**
    * Devuelve el dato $apellido del objeto usuario
    */
   public function getApellido() {
        return $this->apellido;
    }

     /**
    * Devuelve el dato $apellido del objeto usuario
    */
   public function getDni() {
    return $this->dni;
    }
}
